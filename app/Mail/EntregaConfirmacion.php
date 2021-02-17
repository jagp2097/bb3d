<?php

namespace bagrap\Mail;

use bagrap\Pedido;
use bagrap\Archivo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EntregaConfirmacion extends Mailable
{
    use Queueable, SerializesModels;

    protected $archivo, $pedido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Archivo $archivo, Pedido $pedido)
    {
        $this->archivo = $archivo;
        $this->pedido  = $pedido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.EntregaConfirmacion')->with([
          'archivo' => $this->archivo,
          'pedido' => $this->pedido,
        ]);
    }
}
