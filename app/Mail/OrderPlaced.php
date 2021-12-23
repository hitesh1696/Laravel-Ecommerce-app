<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        return $this->to($this->order->billing_email, $this->order->billing_name)
                    ->bcc('another@another.com')
                    ->subject('Order Placed '.$this->order->billing_name .' of Rupees '.round($this->order->billing_total / 100, 2))
                    ->markdown('emails.orders.placed');
    }
}
