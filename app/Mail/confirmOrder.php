<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class confirmOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $firstName;
    public $lastName;
    public $email;
    public $pizzaName;
    public $pizzaPrice;

    public function __construct($firstName, $lastName, $email, $pizzaName, $pizzaPrice)
    {
        //
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->pizzaName = $pizzaName;
        $this->pizzaPrice = $pizzaPrice;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('example@example.com')
                    ->subject('Pizza Order Confirmation')
                    ->view('mail.confirmOrder');
    }
}
