<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function build()
    {
        return $this
            ->from('Anltweb79@gmail.com')
            ->subject('Thank you - Welcome to BAOANSTORE')
            // ->attach(storage_path('app/img/avt/1714637314.jpg'))
            ->markdown('Mail.welcome');
    }
}
