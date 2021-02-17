<?php

namespace bagrap\Mail;

use bagrap\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReembolsoPedido extends Mailable
{
    use Queueable, SerializesModels;

    protected $pedido;
    protected $refundData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Pedido $pedido, $refundData)
    {
        $this->pedido = $pedido;
        $this->refundData = $refundData; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Bb3D - Información de Reembolso')
                    ->view('emails.PedidoReembolso')
                    ->with([
                        'pedido' => $this->pedido,
                        'refundData' => $this->refundData,
        ]);
    }
}
