<?php

namespace bagrap\Http\Controllers;

use Cart;
use Gate;
use Openpay;
use bagrap\User;
use bagrap\Pedido;
use bagrap\Archivo;
use bagrap\Direccion;
use Illuminate\Http\Request;
use bagrap\Mail\PedidoConfirmacion;
use bagrap\Mail\NuevoPedido;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use bagrap\Http\Requests\CheckoutRequest;
use bagrap\Http\Requests\PagoRequest;
use bagrap\Http\Requests\MetPagoRequest;
use Illuminate\Support\Facades\URL;

class PagoController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('isActive');
      $this->middleware('verified');
    }

    public function pagoDireccionView()
    {
        if (Gate::allows('pagoDireccionView') && Cart::count() != 0) {

            session()->forget('pago_tarjeta');
            session()->forget('pago_direccion');
            session()->forget('pago_archivo');
            session()->forget('pago_total');
            session()->forget('cupon');
            session()->forget('response');
            session()->forget('carrito');

            return view('carrito.pago.direccion-envio', [
                'direcciones' => Direccion::where('user_id', '=', Auth::id())->get(),
                'carrito' => Cart::content(),
            ]);
        
        } else {
            return abort(401, 'This action is unauthorized.');
        }
        
    }

    public function pagoDireccion(CheckoutRequest $request)
    {

        if (Gate::allows('pagoDireccion')) {

            if ($request->has('direccion')) {
                if (!$request->session()->has('pago_direccion')) {
    
                    $request->session()->put([
                        'pago_direccion' => $request->only('direccion')
                    ]);
    
                } else {
    
                    $request->session()->put([
                        'pago_direccion' => $request->only('direccion')
                    ]);
    
                }
            } else {
    
                if (!$request->session()->has('pago_direccion')) {
    
                    $request->session()->put([
                        'pago_direccion' => $request->all()
                    ]);
    
                } else {
    
                    $request->session()->put([
                        'pago_direccion' => $request->all()
                    ]);
    
                }
    
            }
            
            // return session()->get('pago_direccion');
            return redirect()->to(route('pago.total'));
        
        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }

    public function pagoTotalView(Request $request)
    {

        if (Gate::allows('pagoTotalView')) {

            return view('carrito.pago.total-pago', [
                'descuento' => $this->getNumbers()->get('descuento'),
                'nuevoSubtotal' => $this->getNumbers()->get('nuevoSubtotal'),
                'nuevoTotal' => $this->getNumbers()->get('nuevoTotal'),
                'newTax' => $this->getNumbers()->get('newTax'),
                'carrito' => Cart::content(),
                // 'archivos' => session()->get('pago_archivo'),
            ]);
        
        } else {
            return abort(401, 'This action is unauthorized.');
        }
 
    }

    public function pagoTotal(Request $request)
    {

        if (Gate::allows('pagoTotal')) {

            if (!$request->session()->has('pago_total')) {

                $request->session()->put([
                    'pago_total' => $this->getNumbers()
                ]);

            } else {

                $request->session()->put([
                    'pago_total' => $this->getNumbers()
                ]);

            }

            return redirect()->to(route('pago.tarjeta'));
        
        } else {
            return abort(401, 'This action is unauthorized.');
        }
 
    }

    public function pagoTarjetaView()
    {
        if (Gate::allows('pagoTarjetaView')) {

            $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');
            $customer = $openpay->customers->get(Auth::user()->openpay_id);
    
            // Obtener tarjetas
            $findDataRequest = [
                //After the creation date.
                'creation[gte]' => Auth::user()->created_at->format('o-m-d'),
                //Before the creation date.
                'creation[lte]' => date('o-m-d'),
                'offset' => 0,
                'limit' => 10

            ];

            $cardList = $customer->cards->getList($findDataRequest);
            $cardsCollection = collect($cardList);
            // $carrito = Cart::content();

            return view('carrito.pago.metodo-pago', [
                'cards'   => $cardsCollection,
            ]);

        } else {
            return abort(401, 'This action is unauthorized.');
        }
        
    }

    public function pagoTarjeta(MetPagoRequest $request)
    {

        if (Gate::allows('pagoTarjeta')) {

            if (!$request->session()->has('pago_tarjeta')) {

                $request->session()->put([
                    'pago_tarjeta' => $request->all()
                ]);
    
            } else {
    
                $request->session()->put([
                    'pago_tarjeta' => $request->all()
                ]);
    
            }
            
            try {


            $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');
            $customer = $openpay->customers->get(Auth::user()->openpay_id);

            $order = array();
    
            foreach (Cart::content() as $row) {
                $order[$row->name] = $row->name;
                $order['Cantidad'] = $row->options->cantidad_paquete;
                $order['Medida'] = $row->options->medida;
                $order['Base'] = $row->options->base;
            };

            $session_total = session()->get('pago_total');
            $session_tarjeta = session()->get('pago_tarjeta');
            
            $chargeData = [
                'method' => 'card',
                'source_id' => '',
                'amount' => $session_total['nuevoTotal'],
                'currency' => 'MXN',
                'description' => 'Pago por '.json_encode($order),
                'device_session_id' => $session_tarjeta['deviceIdHiddenFieldName'],
                'redirect_url' => route('pago.procesando'),
                'use_3d_secure' => 'true',
            ];

            $response = $this->verifyCard($chargeData, $session_tarjeta, $customer);

            return redirect()->to($response->serializableData['payment_method']->url);

    
            } catch (\OpenpayApiError $e) {
    
                return redirect()->to(url()->previous())->with('errors_checkout', 'Error '.$e->getErrorCode().' '.$e->getDescription());
            } 
        
        } else {
            return abort(401, 'This action is unauthorized.');
        }
 
    }  

    public function processingPayment()
    {
        if (Gate::allows('processingPayment')) {

            $openpay = OpenPay::getInstance('mj7glzez1snwbqq4lcfz', 'sk_9469f17116f443caa51861979bcf0a36');
            $payment = $openpay->customers->get(Auth::user()->openpay_id)->charges->get(URL::getRequest()->id);

            // Get the request instance.
            // return URL::getRequest();
        
            if ($payment->status === 'completed') {

                $carrito = Cart::content();
                Cart::destroy();

                session()->forget('pago_tarjeta');
                session()->forget('cupon');

                session()->put([
                    'response' => collect([
                        'holder_name' => $payment->card->serializableData['holder_name'],
                        'response_id' => $payment->id,
                        'response_status' => $payment->status,
                    ]),
                    'carrito' => $carrito,
                ]);


                return redirect()->route('pago.aceptado');

            } else {
                return redirect()->route('pago.rechazado');            
            }
            

        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }

    public function paymentSuccess()
    {

        if (Gate::allows('paymentSuccess')) {
            
            return view('carrito.pago.success');
            

        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }

    public function paymentRefused()
    {

        if (Gate::allows('pagoSuccess')) {
            
            return view('carrito.pago.refused');
            

        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }
    
    public function pagoCargarArchivoView()
    {
        if (Gate::allows('pagoCargarArchivoView')) {

            return view('carrito.pago.cargar-archivo', [
                'archivos' => Archivo::where('user_id', '=', Auth::id())->get(),
                'carrito' => session()->get('carrito'),
                // 'success_checkout' => session('success_checkout'),
            ]);
        
        } else {
            return abort(401, 'This action is unauthorized.');
        }
        
    }

    public function pagoCargarArchivo(PagoRequest $request)
    {         
        // dd($request->hasFile('archivo'));

        if (Gate::allows('pagoCargarArchivo')) {
            
            $referencias = [];
            
            $archivos = $request->archivo;
            asort($archivos);
            // return $archivos;
            
            $archivo = new Archivo();
            $user = User::find(Auth::id());

            $referencias = $this->recorrerArray($archivos, $archivo, $referencias, $user);

            if (!$request->session()->has('pago_archivo')) {

                $request->session()->put([
                    'pago_archivo' => $referencias
                ]);

            } else {

                $request->session()->put([
                    'pago_archivo' => $referencias
                ]);

            }

            return redirect()->to(route('pago.completar'));
        
        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }

    public function pagoCompletar()
    {
        // crear el pedido
        if (Gate::allows('pagoCompletar')) {
    
            $session_direccion = session()->get('pago_direccion');
            $session_archivo = session()->get('pago_archivo');
            $session_total = session()->get('pago_total');
            $session_carrito = session()->get('carrito');
            $session_response = session()->get('response');

            $comentarios = [];

            $pedido = $this->createPedido($session_total, $session_response);


            $pedido->save();
            $this->attachPaquetes($session_carrito, $pedido, $session_archivo, $session_direccion);

            session()->forget('carrito');
            session()->forget('pago_direccion');
            session()->forget('pago_archivo');
            session()->forget('pago_total');
            session()->forget('cupon');
            session()->forget('response');

            $this->sendEmailConfirmationPedido($pedido);
            $this->sendEmailNuevoPedido($pedido);

            return redirect()->route('perfil.show')->with('success_checkout','Compra realizada con éxito');
    
        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }

    private function recorrerArray($arrayArchivos, $archivo, $referencias, $user) {

        // Función para insertar en el array referencias
        function pushReferencias($arrayCargados, $arrayReferencias, $user) {

            $archivosNuevos = [];

            for ($i=0; $i < sizeof($arrayCargados); $i++) {

            // Será true si el elemento del array es un string, este string será el id del archivo que es lo que pasamos cuando se carga un archivo guardado
                if (is_string($arrayCargados[$i])) {
                    $archivo = Archivo::findOrFail($arrayCargados[$i]);
                    $referencia = $archivo->referencia;
                    array_push($arrayReferencias, $referencia);

                } else {
                    $archivo = $arrayCargados[$i];
                    $referencia = time().'-Bb3D-'.$archivo->getClientOriginalName();
                    array_push($arrayReferencias, $referencia);
                    $archivo->move(public_path().'/images/archivos_cliente', $referencia);

                    // dd($archivo);
                    array_push($archivosNuevos, $archivo);

                    $archivo = $user->archivos()->create([
                        'nombre_archivo' => $archivo->getClientOriginalName(),
                        'referencia' => $referencia,
                        'subido_cliente' => true,
                    ]);
                }
            }

            return $arrayReferencias;
        }

        $referencias = pushReferencias($arrayArchivos, $referencias, $user);

        return $referencias;

    }

    function createPedido($session_total, $session_response) {
        $pedido = new Pedido();

        $pedido->user_id = Auth::user()->id;
        $pedido->transaction_id = '';
        $pedido->pedido_email = Auth::user()->email;
        $pedido->pedido_nombre = Auth::user()->perfil->fullname;
        $pedido->pedido_nombre_en_tarjeta = $session_response['holder_name'];
        $pedido->pedido_subtotal = $session_total['nuevoSubtotal'];
        $pedido->pedido_tax = $session_total['newTax'];
        $pedido->pedido_total = $session_total['nuevoTotal'];
        $pedido->error = $session_response['response_status'];
        $pedido->transaction_id = $session_response['response_id'];

        return $pedido;
    }

    private function verifyCard($chargeData, $session_tarjeta, $customer)
    {
        //session tarjeta - verificar si es una tarjeta que tiene guardada u otra que no lo esta.

        // True - significa que será un cargo a una tarjeta guardada.
        if ($session_tarjeta['holder_name'] == null && $session_tarjeta['card_number'] == null && $session_tarjeta['expiration_month'] == null
        && $session_tarjeta['expiration_year'] == null && $session_tarjeta['card'] != null && $session_tarjeta['token_id'] == null) {

            $chargeData['source_id'] = $session_tarjeta['card'];

            $card = $customer->cards->get($session_tarjeta['card']);
            // Se hace el cargo a la tarjeta
            $response = $customer->charges->create($chargeData);

            return $response;

        }

        // True - significa que serÃ¡ un cargo a una tarjeta diferente a las guardadas
        elseif ($session_tarjeta['token_id'] != null && $session_tarjeta['holder_name'] != null && $session_tarjeta['card_number'] != null
        && $session_tarjeta['expiration_month'] != null && $session_tarjeta['expiration_year'] != null ) {

            $chargeData['source_id'] = $session_tarjeta['token_id'];
            // Se hace el cargo a la tarjeta
            $response = $customer->charges->create($chargeData);

            return $response;

        }

    }

    function attachPaquetes($carrito, $pedido, $referencias, $direccion) {
        $productos_session = session()->get('productos');
        $i = 0;
        $direccion;
        foreach ($carrito as $row) {

            if (array_key_exists('direccion', $direccion)) {

                $direccionGuardada = Direccion::findOrFail($direccion['direccion']);

                $pedido->paquetes()->attach($pedido->id, [
                    'paquete_id' => $row->id,
                    'cantidad'   => $productos_session['cantidades'][0][$i]['cantidad'],
                    'medida'     => $productos_session['medidas'][0][$i]['medida'],
                    'base'       => $productos_session['bases'][0][$i]['base'],
                    'archivo'    => $referencias[$i],
                    'entregable' => $row->options['entregable'],
                    'comentario' => null,
                    'pedido_direccion' => $direccionGuardada->calle.', #'.$direccionGuardada->numero,
                    'pedido_codigo_postal' => $direccionGuardada->codigo_postal,
                    'pedido_estado' => $direccionGuardada->estado,
                    'pedido_ciudad' => $direccionGuardada->localidad,
                    'pedido_colonia' => $direccionGuardada->colonia,
                    'pedido_referencia_direccion' => $direccionGuardada->referencias,
                ]);

            } else {

                $pedido->paquetes()->attach($pedido->id, [
                    'paquete_id' => $row->id,
                    'cantidad'   => $productos_session['cantidades'][0][$i]['cantidad'],
                    'medida'     => $productos_session['medidas'][0][$i]['medida'],
                    'base'       => $productos_session['bases'][0][$i]['base'],
                    'archivo'    => $referencias[$i],
                    'entregable' => $row->options['entregable'],
                    'comentario' => null,
                    'pedido_direccion' => $direccion['pedido_calle'].', #'.$direccion['pedido_numero'],
                    'pedido_codigo_postal' => $direccion['pedido_codigo_postal'],
                    'pedido_estado' => $direccion['pedido_estado'],
                    'pedido_ciudad' => $direccion['pedido_ciudad'],
                    'pedido_colonia' => $direccion['pedido_colonia'],
                    'pedido_referencia_direccion' => $direccion['pedido_referencia_direccion'],
                ]);

            }

            $i = $i + 1;

        }

    }

    private function getNumbers()
    {
        // tax = 16 / 100
        $tax = config('cart.tax') / 100;

        // ?? - operador null coalesce: si la session no tiene un cupón de descuento, $descuento tomará el valor de 0
        $descuento = session()->get('cupon')['descuento'] ?? 0;

        $nuevoSubtotal = (Cart::subtotal() - $descuento);
        $newTax = $nuevoSubtotal * $tax;
        $nuevoTotal = $nuevoSubtotal * (1 + $tax);

        // number_format($numero, num_decimales, separador_decimales, separador_millares)
        return collect([
            'tax' => number_format($tax, 2, '.', ''),
            'descuento' => number_format($descuento, 2, '.', ''),
            'nuevoSubtotal' => number_format($nuevoSubtotal, 2, '.', ''),
            'newTax' => number_format($newTax, 2, '.', ''),
            'nuevoTotal' => number_format($nuevoTotal, 2, '.', '')
        ]);

    }

    // Envio de email de confirmacion
    private function sendEmailConfirmationPedido(Pedido $pedido) {
        $pedido = Pedido::findOrfail($pedido->id);
        Mail::to(Auth::user()->email)->send(new PedidoConfirmacion($pedido));
    }

    // Envio de email a administrador
    private function sendEmailNuevoPedido(Pedido $pedido) {
        $pedido = Pedido::findOrfail($pedido->id);

        $admins = User::where('role_id', '=', 1)->get();

        foreach($admins as $admin) {
            Mail::to($admin->email)->send(new NuevoPedido($pedido));
        }
        
    }

}
