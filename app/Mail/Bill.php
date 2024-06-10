<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Bill extends Mailable
{
    use Queueable, SerializesModels;

    public $orderDetail;
    public $totalPrice;

    public function __construct($orderDetail, $totalPrice)
    {
        $this->orderDetail = $orderDetail;
        $this->totalPrice = $totalPrice;
    }

    public function build()
    {
        return $this->subject('Hóa đơn mua hàng tại Cửa hàng Bảo An Store')->view('Mail.bill');
    }
}
