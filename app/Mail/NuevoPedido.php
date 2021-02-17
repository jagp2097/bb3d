<?php

namespace bagrap\Mail;

use bagrap\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NuevoPedido extends Mailable
{
    use Queueable, SerializesModels;

    protected $pedido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bb3D - Nuevo Pedido')
                    ->view('emails.NuevoPedido')
                    ->with([
                        'pedido' => $this->pedido,
                    ]);
    }
}
