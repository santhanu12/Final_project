<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\job;
class TranslateJob implements ShouldQueue
{
    use Queueable,Dispatchable;

    /**
     * Create a new job instance.
     */
    public function __construct(public job $jobListing)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        logger('Translating' .$this->jobListing->title.'to Spanish.' );
    }
}
