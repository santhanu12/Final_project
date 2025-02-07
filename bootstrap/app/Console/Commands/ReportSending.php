<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportSendingMail;

class ReportSending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:report-sending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sending daily report to the manager';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $adminMailId=User::select('email')->where('role','admin')->get();
        $tasks= Task::all();
        $pdf=Pdf::loadView('reports.dailyReport',compact('tasks'))->output(); 

        Mail::to($adminMailId)->send(new ReportSendingMail($pdf));
        return response(['message' => 'report sent successfully']);

    }
}
