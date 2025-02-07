<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\PasswordReset;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class DeliverEmail implements ShouldQueue
{
    use Queueable;
    public $send;
    /**
     * Create a new job instance.
     */
    public function __construct(public $Tosend )
    {
        $this->send=$Tosend;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->send)->send(new PasswordReset());
    }
}
