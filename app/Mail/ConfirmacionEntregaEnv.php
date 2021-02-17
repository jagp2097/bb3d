<?php

namespace bagrap\Mail;

use bagrap\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmacionEntregaEnv extends Mailable
{
    use Queueable, SerializesModels;

    protected $pedido;
    protected $paquetes_entregables;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido, $paquetes_entregables)
    {
        $this->pedido = $pedido;
        $this->paquetes_entregables = $paquetes_entregables;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bb3D - Información de entrega del pedido')
                    ->view('emails.envioPaqueteEnv')
                    ->with([
                        'pedido' => $this->pedido,
                        'paquetes_entregables' => $this->paquetes_entregables,
        ]);
    }
}
