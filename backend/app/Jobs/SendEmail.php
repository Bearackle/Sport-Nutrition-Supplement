<?php

namespace App\Jobs;

use App\Mail\MailPaymentComplelete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;
    public $user;
    public $paymentData;
    /**
     * Create a new job instance.
     */
    public function __construct($user, $paymentData)
    {
        $this->user = $user;
        $this->paymentData = $paymentData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)
            ->send(new MailPaymentComplelete($this->user, $this->paymentData));
    }
}
