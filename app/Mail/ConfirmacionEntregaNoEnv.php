<?php

namespace bagrap\Mail;

use bagrap\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmacionEntregaNoEnv extends Mailable
{
    use Queueable, SerializesModels;

    protected $archivos_entregados;
    protected $pedido;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido, $archivos_entregados)
    {
        $this->archivos_entregados = $archivos_entregados;
        $this->pedido = $pedido;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bb3D - Información de entrega del pedido')
                    ->view('emails.envioPaqueteNoEnv')
                    ->with([
                        'pedido' => $this->pedido,
                        'pedido_paquetes' => $this->pedido->paquetes->where('entregable', '=', 0),
                        'archivos_entregados' => $this->archivos_entregados,
        ]);
    }
}
