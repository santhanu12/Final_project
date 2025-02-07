<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\User;
use App\Mail\endDate;
use Illuminate\Support\Facades\Mail;

class endDateNotice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:end-date-notice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks=Task::all();
        foreach($tasks as $task){
            if($task->end_date === date('Y-m-d')){
              $email=User::select('email')->where('name',$task->name)->get();
                Mail::to($email)->send(new endDate());
            }
        }
    }
}
