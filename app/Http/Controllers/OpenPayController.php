<?php

namespace bagrap\Http\Controllers;

use Cart;
use Openpay;
use bagrap\User;
use bagrap\Pedido;
use bagrap\Archivo;
use bagrap\Paquete_Pedido;
use Illuminate\Http\Request;
use bagrap\Mail\ReembolsoPedido;
use Illuminate\Support\Collection;
use bagrap\Mail\PedidoConfirmacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use bagrap\Http\Requests\CheckoutRequest;
use bagrap\Http\Requests\RefundRequest;
use bagrap\Direccion;


class OpenPayController extends Controller {

	public function __construct() {

		$this->middleware('auth');
		$this->middleware('verified');
		$this->middleware('isActive');
	}

	public function getCardsClient() {

		$openpay = OpenPay::getInstance('mpqoljlvexjbgev0xwyp', 'sk_df7293580ca74a7685d90f3192ded753');
		$this->authorize('getCardsClient', Openpay::class);

		$findDataRequest = [
			//After the creation date.
			'creation[gte]' => Auth::user()->created_at->format('o-m-d'),
			//Before the creation date.
			'creation[lte]' => date('o-m-d'),
			'offset' => 0,
			'limit' => 10
		];

		$customer = $openpay->customers->get(Auth::user()->openpay_id);
		$cardList = $customer->cards->getList($findDataRequest);

		$cardsCollection = collect($cardList);

		return view('openpay.cards', [
			'cards' => $cardsCollection
		]);

	}

	public function addCardForm() {
		$this->authorize('addCardForm', Openpay::class);
		return view('openpay.add-card');
	}

	public function addCardClient(Request $request) {

		$this->authorize('addCardClient', Openpay::class);

		$openpay = OpenPay::getInstance('mpqoljlvexjbgev0xwyp', 'sk_df7293580ca74a7685d90f3192ded753');

		try {

			$cardDataRequest = [
				// 'holder_name'       => $request->input('holder_name'),
				// 'card_number'       => $request->input('card_number'),
				// 'cvv2'              => $request->input('cvv2'),
				// 'expiration_year'   => $request->input('expiration_year'),
				// 'expiration_month'  => $request->input('expiration_month'),
				'device_session_id' => $request->input('deviceIdHiddenFieldName'),
				'token_id'          => $request->input('token_id'),
			];

			$customer = $openpay->customers->get(Auth::user()->openpay_id);
			$card = $customer->cards->add($cardDataRequest);

			return redirect()->to(route('openpay.getCards'))->with('status_card', 'Tarjeta agregada con éxito');

		} catch (\OpenpayApiError $e) {

			return redirect()->to(url()->previous())->with('errors_card', 'Error '.$e->getErrorCode().' '.$e->getDescription());

		}

	}

	public function deleteCardClient($idCard) {
		$this->authorize('deleteCardClient', Openpay::class);

		try {

			$openpay = OpenPay::getInstance('mpqoljlvexjbgev0xwyp', 'sk_df7293580ca74a7685d90f3192ded753');

			$customer = $openpay->customers->get(Auth::user()->openpay_id);
			$card = $customer->cards->get($idCard);
			$card->delete();

			return redirect()->to(route('openpay.getCards'))->with('status_card', 'Tarjeta eliminada con éxito');

		} catch (\OpenpayApiError $e) {

			return redirect()->to(url()->previous())->with('status_card', 'Error '.$e->getErrorCode().' '.$e->getDescription());

		}

	}

	public function checkout(Cart $cart) {
		$this->authorize('checkout', Openpay::class);

		if (Cart::count() == 0) {
			return abort(401, "This action is unauthorized.");
		} else {
			$openpay = OpenPay::getInstance('mpqoljlvexjbgev0xwyp', 'sk_df7293580ca74a7685d90f3192ded753');

			$customer = $openpay->customers->get(Auth::user()->openpay_id);

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
			// return view('carrito.confirmar', [
				'cards'   => $cardsCollection,
				// 'direcciones' => Direccion::where('user_id', '=', Auth::id())->get(),
				// 'carrito' => $carrito,
			]);
		}
	}

	public function chargeToCard(Request $request) {
		return $request;

		if (Cart::count() != 0) {
			try {

				$user = User::find(Auth::id());

				$openpay = OpenPay::getInstance('mpqoljlvexjbgev0xwyp', 'sk_df7293580ca74a7685d90f3192ded753');
				$customer = $openpay->customers->get($user->openpay_id);

				$referencias = [];
				$comentarios = [];

				if ($request->hasFile('archivo_pedido') || $request->hasFile('archivo_pedido_enviar')) {

					$archivo = new Archivo();

					if ($request->has('archivo_pedido') && !($request->has('archivo_pedido_enviar'))) {

						$referencias = $this->recorrerArray($request->archivo_pedido, $archivo, $referencias, $user);

					}

					elseif ($request->has('archivo_pedido_enviar') && !($request->has('archivo_pedido'))) {

						$referencias = $this->recorrerArray($request->archivo_pedido_enviar, $archivo, $referencias, $user);
					}

					elseif ($request->has('archivo_pedido') && $request->has('archivo_pedido_enviar')) {

						$referencias = $this->recorrerArray($request->archivo_pedido, $archivo, $referencias, $user);
						$referencias = $this->recorrerArray($request->archivo_pedido_enviar, $archivo, $referencias, $user);

					}
				}

				// dd(Cart::content());

				$pedido = $this->createPedido($request);

				$order = array();

				foreach (Cart::content() as $row) {
					$order[$row->name] = $row->qty;
				};

				$chargeData = [
					'method' => 'card',
					'source_id' => '',
					'amount' => Cart::total(),
					'currency' => 'MXN',
					'description' => 'Pago por '.json_encode($order),
					'device_session_id' => $request->input("deviceIdHiddenFieldName"),
				];

				// True - significa que serÃ¡ un cargo a una tarjeta guardada.
				if ($request->input('holder_name') == null && $request->input('card_number') == null && $request->input('expiration_month') == null && $request->input('expiration_year') == null && $request->input('card') != null && $request->input('token_id') == null) {

					$chargeData['source_id'] = $request->input('card');
					$card = $customer->cards->get($request->input('card'));
					$resp = $customer->charges->create($chargeData);

					// $pedido->pedido_nombre_en_tarjeta = $card->serializableData['holder_name'];
					$pedido->pedido_nombre_en_tarjeta = $card->serializableData['holder_name'];
					$pedido->error = $resp->status;
					$pedido->transaction_id = $resp->id;

				}

				// True - significa que serÃ¡ un cargo a una tarjeta diferente a las guardadas
				elseif ( $request->input('token_id') != null && $request->input('holder_name') != null && $request->input('card_number') != null && $request->input('expiration_month') != null && $request->input('expiration_year') != null ) {

					$chargeData['source_id'] = $request->input('token_id');
					$resp = $customer->charges->create($chargeData);

					$pedido->pedido_nombre_en_tarjeta = $request->input('holder_name');
					$pedido->error = $resp->status;
					$pedido->transaction_id = $resp->id;

				}

				$pedido->save();
				$this->attachPaquetes(Cart::content(), $pedido, $referencias, $request);

				Cart::destroy();
				session()->forget('cupon');

				$this->sendEmailConfirmationPedido($request, $pedido);

				return redirect()->route('perfil.show')->with('success_checkout','Compra realizada con éxito');

			} catch (\OpenpayApiError $e) {

				$pedido = $this->createPedido($request);

				// True - significa que serÃ¡ un cargo a una tarjeta guardada.
				if ($request->input('holder_name') == null && $request->input('card_number') == null && $request->input('expiration_month') == null && $request->input('expiration_year') == null && $request->input('card') != null && $request->input('token_id') == null) {

					$card = $customer->cards->get($request->input('card'));
					// $pedido->pedido_nombre_en_tarjeta = $card->serializableData['holder_name'];
					$pedido->pedido_nombre_en_tarjeta = $card->serializableData['holder_name'];
					$pedido->error = "Cancelado - ".$e->getDescription();

				}

				// True - significa que serÃ¡ un cargo a una tarjeta diferente a las guardadas
				elseif ( $request->input('token_id') != null && $request->input('holder_name') != null && $request->input('card_number') != null && $request->input('expiration_month') != null && $request->input('expiration_year') != null ) {

					$pedido->pedido_nombre_en_tarjeta = $request->input('holder_name');
					$pedido->error = "Cancelado - ".$e->getDescription();

				}

				$pedido->save();
				$this->attachPaquetes(Cart::content(), $pedido, $referencias, $request);

				return redirect()->to(url()->previous())->with('errors_checkout', 'Error '.$e->getErrorCode().' '.$e->getDescription());
			}

		} else {
			return abort(401, "This action is unauthorized.");
		}

	}

	public function refund(RefundRequest $request, $customer_id, $transaction_id) {

		try {

			$openpay = OpenPay::getInstance('mpqoljlvexjbgev0xwyp', 'sk_df7293580ca74a7685d90f3192ded753');

			$refundData = [
				'description' => $request->input('description_refund'),
				'amount' => $request->input('amount_refund'),
			];

			$this->sendEmailRefund($request, $transaction_id, $refundData);
			$customer = $openpay->customers->get($customer_id);
			$charge = $customer->charges->get($transaction_id);
			$charge->refund($refundData);

			$pedido = Pedido::where('transaction_id', '=', $transaction_id)->firstOrFail();
			$pedido->update([
				'error' => "Reembolso - Causa - {$refundData['description']} - Cantidad - {$refundData['amount']}",
			]);

			return redirect()->route('pedidos.index');

			} catch (\OpenpayApiError $e) {

				return redirect()->to(url()->previous())->with('errors', 'Error '.$e->getErrorCode().' '.$e->getDescription());
			}
	}

	function recorrerArray($arrayArchivos, $archivo, $referencias, $user) {
		for ($i=0; $i < sizeof($arrayArchivos) ; $i++) {

			$archivo = $arrayArchivos[$i];
			$referencia = time().$archivo->getClientOriginalName();
			array_push($referencias, $referencia);
			$archivo->move(public_path().'/images/archivos_productos', $referencia);

			$archivo = $user->archivos()->create([
				'nombre_archivo' => $archivo->getClientOriginalName(),
				'referencia' => $referencia,
				'subido_cliente' => true,
				]);
			}

			return $referencias;

	}

	function createPedido($request) {
		$pedido = new Pedido();

		$pedido->user_id = Auth::user()->id;
		$pedido->transaction_id = '';
		$pedido->pedido_email = $request->input('pedido_email');
		$pedido->pedido_nombre = $request->input('pedido_nombre');
		$pedido->pedido_nombre_en_tarjeta = '';
		$pedido->pedido_subtotal = $this->getNumbers()->get('nuevoSubtotal');
		$pedido->pedido_tax = $this->getNumbers()->get('newTax');
		$pedido->pedido_total = $this->getNumbers()->get('nuevoTotal');
		$pedido->error = '';

		return $pedido;
	}

	function attachPaquetes($carrito, $pedido, $referencias, $request) {
		$i = 0;
		foreach ($carrito as $row) {
			if ($request->filled('pedido_codigo_postal') && $request->filled('pedido_estado') && $request->filled('pedido_ciudad') && $request->filled('pedido_colonia') && $request->filled('pedido_referencia_direccion') && $request->filled('pedido_calle') && $request->filled('pedido_numero') && $row->options['entregable'] == 1) {

				$pedido->paquetes()->attach($pedido->id, [
					'paquete_id' => $row->id,
					'cantidad'   => $row->qty,
					'archivo'    => $referencias[$i],
					'entregable' => $row->options['entregable'],
					'comentario' => $request->comentario_pedido[$i],
					'pedido_direccion' => $request->input('pedido_calle').', #'.$request->input('pedido_numero'),
					'pedido_codigo_postal' => $request->input('pedido_codigo_postal'),
					'pedido_estado' => $request->input('pedido_estado'),
					'pedido_ciudad' => $request->input('pedido_ciudad'),
					'pedido_colonia' => $request->input('pedido_colonia'),
					'pedido_referencia_direccion' => $request->input('pedido_referencia_direccion'),
					]);
				} else {
					$pedido->paquetes()->attach($pedido->id, [
						'paquete_id' => $row->id,
						'cantidad'   => $row->qty,
						'archivo'    => $referencias[$i],
						'entregable' => $row->options['entregable'],
						'comentario' => $request->comentario_pedido[$i],
						]);
					}

					$i = $i + 1;

		}

	}

	//metodo llamado en la funcion chargeTo card.
	function sendEmailConfirmationPedido(Request $request, Pedido $pedido) {

		$pedido = Pedido::findOrfail($pedido->id);
		// return (new PedidoConfirmacion($pedido))->render();
		Mail::to($request->user())->send(new PedidoConfirmacion($pedido));
	}

	function sendEmailRefund(Request $request, $transaction_id, $refundData) {

		$pedido = Pedido::where('transaction_id', '=', $transaction_id)->first();
		$user = User::findOrFail($pedido->user_id);
		// $refundData;
		// return $request;
		// return (new ReembolsoPedido($pedido, $refundData))->render();
		Mail::to($user->email)->send(new ReembolsoPedido($pedido, $refundData));

	}

}
