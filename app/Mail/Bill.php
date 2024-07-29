<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;

class Bill extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $order;
    public $orderDetails;
    public $totalPrice;


    public function __construct(Order $order, $orderDetails, $totalPrice)
    {
        $this->order = $order;
        $this->orderDetails = $orderDetails;
        $this->totalPrice = $totalPrice;
    }

    public function build()
    {
        return $this->view('Mail.bill')
                    ->with([
                        'order' => $this->order,
                        'orderDetails' => $this->orderDetails,
                        'totalPrice' => $this->totalPrice,
                    ]);
    }
}
