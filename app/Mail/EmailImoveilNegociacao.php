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
public $nome_marca_visita;
public $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $mensagem,string $nome_marca_visita, string $url)
    {
        $this->mensagem=$mensagem;
        $this->nome_marca_visita=$nome_marca_visita;
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
