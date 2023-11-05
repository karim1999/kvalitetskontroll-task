<?php

namespace App\Http\Controllers;

use App\Actions\AddProductToOrderAction;
use App\Actions\CheckProductStockAction;
use App\Actions\ListOrdersAction;
use App\Actions\SubmitOrderAction;
use App\Http\Requests\AddProductToCartRequest;
use App\Http\Requests\ListOrderRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderResourceCollection;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * List orders paginated
     * @param ListOrderRequest $request
     * @param ListOrdersAction $listOrdersAction
     * @return OrderResourceCollection
     */
    public function index(ListOrderRequest $request, ListOrdersAction $listOrdersAction): OrderResourceCollection
    {
        $validated = $request->validated();
        $page = $validated['page'] ?? 1;
        $perPage = $validated['per_page'] ?? 10;
        $userId = $validated['user_id'] ?? null;
        $data = $listOrdersAction->handle($page, $perPage, $userId);
        return new OrderResourceCollection($data);
    }

    /**
     * Show order by id
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        // We can use an action to get an order by id, but it's not necessary
        return new OrderResource($order);
    }

    /**
     * Add product to cart
     * @param AddProductToCartRequest $request
     * @param AddProductToOrderAction $addProductToOrderAction
     * @return JsonResponse
     */
    public function addToCart(AddProductToCartRequest $request, AddProductToOrderAction $addProductToOrderAction): JsonResponse
    {
        $validated = $request->validated();
        $userId = $validated['user_id'];
        $userName = $validated['user']['name'];
        $productId = $validated['product_id'];
        $qty = $validated['quantity'];
        $addProductToOrderAction->handle($userId, $productId, $qty, $userName);
        return response()->json([
            'message' => 'The product is being added to the cart.',
        ]);
    }

    /**
     * Submit order
     * @param Order $order
     * @param SubmitOrderAction $submitOrderAction
     * @return OrderResource
     */
    public function submit(Order $order, SubmitOrderAction $submitOrderAction): OrderResource
    {
        $order = $submitOrderAction->handle($order->id);
        return new OrderResource($order);
    }
}
