<?php

namespace App\Actions;

class PublishMessageAction
{
    /**
     * Check product stock
     * @param string $eventName
     * @param mixed $eventData
     * @return void
     */
    public function handle(string $eventName, mixed $eventData): void
    {
        $message = json_encode([
            'event_name' => $eventName,
            'event_data' => $eventData,
        ]);
        \Amqp::publish('', $message , [
            'exchange_type' => 'fanout',
            'exchange' => 'amq.fanout',
        ]);
    }
}
