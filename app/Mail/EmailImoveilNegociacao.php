<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailImoveilNegociacao extends Mailable
{
    use Queueable, SerializesModels;
public $mensagem;
public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $mensagem,string $url)
    {
        $this->mensagem=$mensagem;
        $this->url=$url;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.name',[
            'url' => $this->url,
        ]);
    }
}
