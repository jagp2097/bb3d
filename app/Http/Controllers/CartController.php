<?php

namespace bagrap\Http\Controllers;

use Cart;
use Gate;
use bagrap\Paquete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth')->except(['addToCartWhout']);
      $this->middleware('isActive')->except(['addToCartWhout']);

    // $this->middleware('verified');
  }

    public function inCart()
    {
        if (Gate::allows('inCart')) {
            $cart_content = Cart::content();
            return view('carrito.en-carrito', [
                'cart_content' => $cart_content,
            ]);
        } else {
            return abort(401, 'This action is unauthorized.');
        }
    }

    public function addToCart(Request $request)
    {
        if (Gate::allows('addToCart')) {
            $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
                return $cartItem->id === $request->paquete_id;
            });
    
            if ($duplicates->isNotEmpty()) {
                return redirect()->route('paquete.index')->with('status', 'Producto ya incluido en tú carrito');
            }
            // number_format($numero, num_decimales, separador_decimales, separador_millares)
            $cart = Cart::add([
                'id'    => $request->paquete_id,
                'name'  => $request->paquete_nombre,
                'qty'   => "1",
                'price' => $request->paquete_precio,
                'options' => [
                    'imagen_paquete' => Paquete::findOrFail($request->paquete_id)->foto,
                    'entregable' => Paquete::findOrFail($request->paquete_id)->entregable,
                    'medida' => '',
                    'base' => '',
                    'cantidad_paquete' => '1',
                ],
            ]);
    
            return redirect()->route('paquete.index');

        } else {
            return abort(401, 'This action is unauthorized.');
        }
        
    }

    public function addToCartWhout(Request $request) 
    {

        if(!Auth::check()) {
            
            Cart::add([
                'id'    => $request->paquete_id,
                'name'  => $request->paquete_nombre,
                'qty'   => "1",
                'price' => $request->paquete_precio,
                'options' => [
                    'imagen_paquete' => Paquete::findOrFail($request->paquete_id)->foto,
                    'entregable' => Paquete::findOrFail($request->paquete_id)->entregable,
                    'medida' => '',
                    'base' => '',
                    'cantidad_paquete' => '1',
                   ],
            ]);
            // return session()->all();

            return redirect()->route('paquete.medidas');

        } elseif(Auth::check()->role_id == 2) {

            $cart = Cart::add([
                'id'    => $request->paquete_id,
                'name'  => $request->paquete_nombre,
                'qty'   => "1",
                'price' => $request->paquete_precio,
                'options' => [
                    'imagen_paquete' => Paquete::findOrFail($request->paquete_id)->foto,
                    'entregable' => Paquete::findOrFail($request->paquete_id)->entregable,
                    'medida' => '',
                    'base' => '',
                    'cantidad_paquete' => '1',
                ],
            ]);

            return redirect()->route('paquete.medidas');

        } elseif (Auth::check()->role_id == 1) {
            return redirect()->route('perfil.show');
        }

    }

    public function removeItem($rowId)
    {
        if (Gate::allows('removeItem')) {
            Cart::remove($rowId);
            return redirect()->route('cart.content');
        } else {
            return abort(401, 'This action is unauthorized.');
        }
    }

    public function updateQtyItem(Request $request, $paquete_id)
    {
        if (Gate::allows('updateItem')) {
            Cart::update($request->rowId, $request->new_qty);
            return response()->json([
                'rid' => $request->rowId,
                'qty' => $request->new_qty,
            ]);
        } else {
            return abort(401, 'This action is unauthorized.');
        }
    }

    public function destroyCart()
    {
        if (Gate::allows('destroyCart')) {
            Cart::destroy();
            return redirect()->route('paquete.index');
        } else {
            return abort(401, 'This action is unauthorized.');
        }
    }
    
}
