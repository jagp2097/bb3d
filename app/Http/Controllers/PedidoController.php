<?php

namespace bagrap\Http\Controllers;

use Openpay;
use bagrap\User;
use bagrap\Pedido;
use bagrap\Archivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use bagrap\Mail\ConfirmacionEntregaEnv;
use bagrap\Http\Requests\CompleteRequest;
use bagrap\Mail\ConfirmacionEntregaNoEnv;

class PedidoController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('isActive');

    // $this->middleware('verified');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $this->authorize('index', Pedido::class);
        $pedidos = Pedido::where('id', '>', 0)->orderBy('created_at', 'desc')->simplePaginate(7);

        return view('admin.pedidos.index', [
          'pedidos' => $pedidos
        ]);
        
    }

    public function refundForm($user_id, $transaction_id, $pedido)
    {
      $this->authorize('refundForm', Pedido::class);
      $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');

      $user = User::findOrFail($user_id);

      $customer = $openpay->customers->get($user->openpay_id);
      $charge = $customer->charges->get($transaction_id);

      $pedido = Pedido::findOrFail($pedido);

      return view('admin.pedidos.refund', [
        'charge' => $charge,
        'pedido' => $pedido,
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        $pedido = Pedido::findOrFail($pedido->id);
        return view('admin.pedidos.show', [
            'pedido' => $pedido
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
      $this->authorize('update', Pedido::class);
      return view('admin.pedidos.edit', [
        'pedido' => $pedido
      ]);
    }

    public function complete($pedido)
    {
      $pedido = Pedido::findOrFail($pedido);
      return view('admin.pedidos.complete', [
        'pedido' => $pedido
      ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(CompleteRequest $request, Pedido $pedido)
    {
      // Encontrar al usuario que hizo el pedido
      $user = User::findOrFail($pedido->user_id);
      
      // Separar los que se enviaran y los que seran un archivo para subir
      $paquetes_enviables  = [];
      $paquetes_no_enviables = [];
      $archivos_entregados = [];
      

      foreach ($pedido->paquetes as $paquete) {
        if ($paquete->entregable == 1) {
          array_push($paquetes_enviables, $paquete);
        }
        // False - el paquete no se debe enviar y se almacena en el array $paquetes_no_enviables
        else {
          array_push($paquetes_no_enviables, $paquete);
        }  
      }

      //Ver si el request tiene el campo archivo_pedido_completado y ver que sea igual de cantidad a los paquetes que se enviarán
      if ($request->has('archivo_pedido_completado') && sizeof($request->allFiles()) == sizeof($paquetes_no_enviables)) {
        // return "1";

        // Objeto archivo para crear un archivo al usuario.
        $archivo = new Archivo();
        // For para crear los archivos que seran enviados al usuario
        for ($i = 0; $i < sizeof($paquetes_no_enviables); $i++) {

          $archivo = $request->archivo_pedido_completado[$i];
          $referencia = time().$archivo->getClientOriginalName();
          $archivo->move(public_path().'/images/archivos_cliente', $referencia);

          $archivo = $user->archivos()->create([
            'nombre_archivo' => $archivo->getClientOriginalName(),
            'referencia' => $referencia,
            'subido_cliente' => false,
          ]);

          array_push($archivos_entregados, $archivo);

        }

        //Enviar correo al cliente notificando de los archivos apareceran en sus archivos.
        Mail::to($user->email)->send(new ConfirmacionEntregaNoEnv($pedido, $archivos_entregados)); 
        // return (new ConfirmacionEntregaNoEnv($pedido, $archivos_entregados))->render(); 

        if (sizeof($paquetes_enviables) > 0) {
          // Enviar email al correo del cliente con las instrucciones para recibir su pedido en la dirección indicada
          Mail::to($user->email)->send(new ConfirmacionEntregaEnv($pedido, $paquetes_enviables));
          // return (new ConfirmacionEntregaEnv($pedido, $paquetes_enviables))->render();
        }

        // Caompletar el pedido
        $pedido->update([
          'entregado' => 1,
        ]);

        return redirect()->route('pedidos.index');

      } elseif (!($request->has('archivo_pedido_completado')) && sizeof($request->allFiles()) == sizeof($paquetes_no_enviables)) {
        // return "2";
        
         //   return "no trae";
        //  El request no trae archivos, son paquetes que serán enviados
        foreach ($pedido->paquetes as $paquete) {
          //Verifocar que tipo de paquete es y almacenarlos en el array $archuivos_enviables
          array_push($paquetes_enviables, $paquete);
        }
        
        Mail::to($user->email)->send(new ConfirmacionEntregaEnv($pedido, $paquetes_enviables));
        
        $pedido->update([
          'entregado' => 1,
        ]);

        return redirect()->route('pedidos.index');

      } elseif (!($request->has('archivo_pedido_completado')) && sizeof($paquetes_no_enviables) > 0) {
        // return "3";
        return redirect()->to(url()->previous())->with('errors_complete', 'Por favor cargue los archivos correspondientes al paquete adquirido por el cliente.');

      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
