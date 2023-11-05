<?php

namespace App\Jobs;

use App\Mail\OrderCompleted;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public string $email;
    /**
     * @var int
     */
    public int $orderId;
    /**
     * @var int
     */
    public int $userId;

    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->email = $data['email'];
        $this->orderId = $data['order_id'];
        $this->userId = $data['user_id'];
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new OrderCompleted());
    }
}
