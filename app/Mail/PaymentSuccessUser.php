<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentSuccessUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $payment;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $payment)
    {
        $this->user = $user;
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Payment Successful')
                    ->view('emails.payment_success_user')
                    ->with([
                        'user' => $this->user,
                        'payment' => $this->payment,
                    ]);
    }
}
