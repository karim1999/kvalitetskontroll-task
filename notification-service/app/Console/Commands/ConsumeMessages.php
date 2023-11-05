<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ConsumeMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consume:messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from RabbitMQ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Consuming messages...');
        \Amqp::consume('', function ($message, $resolver) {
            $this->info($message->body);
            $serializedMessage = $message->body;
            try {
                $messageData = json_decode($serializedMessage, true);
                if (isset($messageData['event_name']) && isset($messageData['event_data'])) {
                    $eventClass = config('messages.' . $messageData['event_name']);
                    if($eventClass) {
                        $eventData = $messageData['event_data'];
                        // Dynamically dispatch the event using the job class
                        $eventClass::dispatch($eventData);
                    }
                }
            }catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            $resolver->acknowledge($message);
        }, [
            'routing' => '',
        ]);
    }
}
