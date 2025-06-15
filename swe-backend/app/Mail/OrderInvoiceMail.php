<?php

namespace App\Mail;

use App\Models\Sneaker\SneakerOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public SneakerOrder $order
    ) {}

    public function build()
    {
        return $this->subject("Invoice for Order #{$this->order->id}")
                    ->markdown('emails.order-invoice', [
                        'order' => $this->order,
                    ]);
    }
}
