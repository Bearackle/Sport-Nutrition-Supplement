<?php

namespace App\Jobs;

use App\Mail\MailCartUncomplete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendCartUncomplete implements ShouldQueue
{
    use Queueable;
    protected $user;
    protected $data;
    /**
     * Create a new job instance.
     */
    public function __construct($user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user->email)
            ->send(new MailCartUncomplete($this->user, $this->data));
    }
}
