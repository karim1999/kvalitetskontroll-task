# Laravel Task
## Technical Implementation

In this document, I will explain various technical aspects of the microservices-based project that I have developed based on the given assignment. The project is designed to handle orders of products for users and administration, with a focus on scalability, modularity, and best practices.

### 1. Database Per Service vs. Shared Database

For this project, a database per service approach has been chosen, and it is considered better than using a shared database for the following reasons:

- **Isolation**: Each microservice has its own database, ensuring data isolation. This helps avoid data coupling and minimizes the risk of unintended data access or modification.

- **Scaling Independently**: With separate databases, services can be scaled independently as needed. This approach is particularly advantageous for services with varying load requirements.

- **Faster Development**: Microservices can evolve at their own pace, and developers can work on individual services without conflicts arising from schema changes.

### 2. Scalability

Although this project is relatively simple, scalability has been a concern from the beginning. The use of microservices architecture and separate databases allows for horizontal scaling, meaning more instances of a service can be deployed to handle increased loads as necessary. This ensures that the system can grow to meet higher user demands.

### 3. API Gateway and Middleware

An API Gateway is used to manage and route requests to the respective microservices. This approach offers several advantages:

- **Routing**: It routes incoming HTTP requests to the appropriate microservice based on the request's endpoint.

- **Authentication**: The User and Admin middleware utilize the User and Admin services to perform authentication. Once authenticated, user details are automatically injected into the subsequent service requests from the API Gateway.

- **Security**: The API gateway is where API documentation is generated and available for users. The API documentation is generated using the Scribe tool.

- **Documentation**: The API gateway is where API documentation is generated and available for users. The API documentation is generated using the Scribe tool.

### 4. Benefits of API Gateway

The API Gateway offers numerous advantages:

- **Centralized Entry Point**: All external communication goes through a single entry point, which simplifies monitoring, load balancing, and security enforcement.

- **Load Balancing**: The API Gateway can distribute incoming requests to different instances of microservices to ensure even distribution of load.

- **Rate Limiting and Throttling**: It allows for implementing rate limiting and throttling to prevent abuse and manage resource consumption.

- **Logging and Analytics**: Centralized logging and analytics can be implemented at the API Gateway for comprehensive monitoring and troubleshooting.

### 5. API Documentation

API documentation has been provided for a limited number of endpoints. It's generated for the endpoints using the Scribe tool and is only available in the API gateway. This documentation makes it easier for users to understand the available endpoints, their purposes, and how to use them. These documentations show only some basic information about the endpoints, but it can be extended to include more details.

### 6. Service Visibility

All services are hidden from direct internet access, and only the API Gateway is publicly visible. This provides an added layer of security and ensures that services are not directly exposed to potential threats.

### 7. Docker and Docker Compose

Docker and Docker Compose have been used for development to containerize each service and map them to different ports. This approach allows for consistent development environments and easy deployment to different environments, including production.

### 8. Layered Architecture

For most of the services, two additional layers were added to the standard Laravel MVC structure:

- **Repository Layer**: This acts as the data layer, providing an abstraction for database operations. It separates the database logic from the application's business logic.

- **Action Layer**: This layer is responsible for handling the business logic and orchestrating interactions between the controller and repository layers. It keeps controllers focused on receiving requests and configuring responses.

The typical Laravel layers such as Controllers, Requests for validation, and API Resources for responses were used. This structured approach offers several benefits:

- **Separation of Concerns**: It promotes a clean separation of concerns, making code easier to maintain and test.

- **Reusability**: Actions can be reused in multiple controllers, ensuring code efficiency.

- **Testability**: Isolating the logic in the Action layer makes it easier to write unit tests for the business logic.

### 9. Testing

Feature tests have been created for some endpoints in the product and order services, ensuring the functionality is thoroughly tested.

### 10. RabbitMQ Communication

RabbitMQ is used for communication between services. In particular:

- **Product Service and Order Service**: RabbitMQ is used to check product availability when adding products to an order. This asynchronous communication ensures that products are available before they are added to an order.

- **Order Service and Notification Service**: RabbitMQ is used to send email notifications when an order is completed. This event-driven architecture ensures that orders are processed efficiently.


### 11. Endpoints for Demonstrating Knowledge

It's important to note that while certain logical components are mentioned in the design, the focus of this assignment was to showcase architecture and development skills rather than implement complex business logic. For example, the logic for updating product stock when an order is completed is mentioned, but the event handling in the Product service is not detailed.

This project is designed to demonstrate a sound architectural foundation for a microservices-based system, leaving the detailed implementation of business logic for further development.

## Services

- **API Gateway Service:** The API gateway is responsible for routing requests to specific services or combining service calls. It is the only service accessible through the internet.

- **User Service:** This service manages user-related logic, data, and authentication.

- **Admin Service:** The admin service handles admin-specific logic, data, and authentication.

- **Order Service:** Responsible for managing order-related logic and data.

- **Product Service:** Manages product-related logic and data.

- **Notification Service:** Handles notifications for the application.

Each service has its own database for data storage and retrieval.

## Tech

The application is built using the following technologies:

- **Laravel:** A popular PHP web application framework known for its elegant syntax and extensive feature set.
- **PostgreSQL:** A powerful open-source relational database management system for data storage and retrieval.
- **Docker & Docker Compose:** Containerization technology that simplifies application deployment and management.
- **RabbitMQ:** A message broker that enables communication between microservices using the AMQP protocol.

## Purpose

The purpose of this E-commerce application is to provide a scalable, secure, and efficient platform for managing e-commerce operations. It enables users to browse products, make purchases, manage their accounts, and receive notifications about their orders.

## Installation

To set up the application for development purposes, follow these steps:

- Clone the repository to your local machine.

```bash
git clone <repository-url>
```

- Navigate to the project directory.

```bash
cd <project-folder>
```

- Create a `.env` file for each service based on the provided sample `.env.example` files. Configure your environment variables, including database connections and API keys.

- Build and run the application using Docker Compose.

```bash
docker-compose up -d
```

- Run the composer package install command.

```bash
docker-compose exec <service-name> composer install
```


- Generate a key for each application.

```bash
docker-compose exec <service-name> php artisan key:generate
```

- Run the database migrations and seeders for each service.

```bash
docker-compose exec <service-name> php artisan migrate --seed
```

- Run queue workers for each service. (Rabbitmq queues can be used if needed)

```bash
docker-compose exec <service-name> php artisan queue:listen
```

- Run Message consumers for each service. For now only the (order, product, notification) services have consumers.

```bash
docker-compose exec <service-name> php artisan consume:messages
```

- You can access the services through their respective endpoints, and the API Gateway will handle the routing. The API Gateway is the only service accessible via the internet.

- Start developing your features and functionality within each service as needed.

## Deployment


This section provides instructions for deploying the microservices application from the monorepo. In this architecture, each microservice will be deployed separately, and they should have access to their own databases. Additionally, we will ensure that all services are hidden in the network, except for the API Gateway service, which will handle incoming requests and route them to the appropriate microservice. All services will exist within the same network for optimal performance, and RabbitMQ will be used for message queueing.

### Prerequisites

Before deploying the microservices application, make sure you have the following prerequisites in place:

1. **Access to Cloud Services**: You should have access to a cloud provider like AWS, GCP, or Azure for deploying your services and managing databases.

2. **Databases**: If required, set up your databases. You can use cloud-based databases like Amazon RDS, Google Cloud SQL, or Azure Database, or you can set up your own databases.

3. **API Gateway**: Ensure you have set up an API Gateway service, which will be the entry point for incoming requests.

4. **RabbitMQ**: If you choose to use RabbitMQ for message queueing, you can either set up your own RabbitMQ server or use a cloud provider's managed service.

5. **Docker and Container Orchestration**: You should have Docker installed to containerize your microservices. If needed, set up a container orchestration system.

6. **Source Code**: Clone the repository containing your microservices code.

## Deployment Steps

Follow these steps to deploy the microservices application:

1. **Database Setup**:
    - Set up a separate database for each microservice. This could be a cloud-based solution like Amazon RDS or a self-hosted database.
    - Configure the database connection string and credentials for each microservice, ensuring they have access only to their respective databases.

2. **Microservice Containerization**:
    - Dockerize each microservice by creating a Dockerfile for each service. Include all dependencies and application code.
    - Build Docker images for each microservice.

3. **Container Orchestration** (Optional):
    - If you are using a container orchestration system like Kubernetes, create Kubernetes deployment and service files for each microservice.
    - Deploy these services to your cluster.

4. **API Gateway Configuration**:
    - Configure the API Gateway to map incoming requests to the appropriate microservices based on the requested endpoints.

5. **RabbitMQ Configuration**:
    - Set up RabbitMQ for message queueing. You can use a cloud provider's managed RabbitMQ service or set up your own.
    - Ensure that each microservice is configured to interact with RabbitMQ for asynchronous communication.

6. **Network Configuration**:
    - Place all microservices within the same network to improve performance.
    - Configure network policies to block external traffic to all microservices except the API Gateway.

7. **Deployment and Scaling**:
    - Deploy each microservice, making sure they can communicate with their respective databases and the RabbitMQ service.
    - Monitor the performance of your services and scale them as needed.

8. **Logs and Monitoring**:
    - Implement logging and monitoring solutions to keep track of the performance and health of your microservices. Services like Prometheus and Grafana can be helpful in this regard.

9. **Security**:
    - Ensure that all communication between microservices is secured and that sensitive information, such as database credentials, is properly protected.

10. **Documentation and Testing**:
    - Document the deployment process for each microservice.
    - Test the entire application to verify that all services are working together as expected.