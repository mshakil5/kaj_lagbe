<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WorkAssignedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;

    public function __construct($emailData)
    {
         $this->emailData = $emailData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Work Assigned Mail',
        );
    }

    public function build()
    {
        return $this->from('solomon@example.co.uk', 'Solomon Maintainance')
                    ->subject($this->emailData['subject'])
                    ->markdown('emails.workAssigned')
                    ->with('emailData', $this->emailData);
    }

}
