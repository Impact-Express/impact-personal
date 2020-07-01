<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customerName, $shipmentId)
    {
        $this->name = $customerName;
        $this->id = $shipmentId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("orders@impactexpress.co.uk")->view('emails.bookingConfirmation');
    }
}
