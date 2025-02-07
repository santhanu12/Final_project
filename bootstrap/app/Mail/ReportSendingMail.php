<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReportSendingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pdf;

    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Report',
        );
    }


    public function content(): Content
    {
        return new Content(
            markdown: 'mail.reportSending',
        );
    }


    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Daily Report')
                    ->view('mail.reportSending')
                    ->attachData($this->pdf, 'database_report.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
