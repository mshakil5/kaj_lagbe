<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CallbackMail extends Mailable
{
    use Queueable, SerializesModels;
     public $userData;

    /**
     * Create a new message instance.
     */
    public function __construct($userData)
    {
        $this->userData  = $userData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Callback Mail',
        );
    }

    public function build()
    {
        return $this->from('solomon@example.co.uk', 'Solomon Maintainance')
                    ->subject($this->userData['subject'])
                    ->markdown('emails.callback')
                    ->with([
                        'userData' => $this->userData,
                    ]);
    }

    
}
