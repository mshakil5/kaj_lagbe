<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    public $array;
    /**
     * Create a new message instance.
     */
    public function __construct($array)
     {
         $this->array = $array;
     }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contact Message Mail',
        );
    }

    public function build()
    {
        return $this->from('solomon@example.co.uk', 'Solomon Maintainance')
                    ->subject($this->array['subject'])
                    ->markdown('emails.contact_message');
    }

}
