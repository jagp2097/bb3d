<?php

namespace bagrap\Http\Controllers;

use Cart;
use bagrap\User;
use bagrap\Coupon;
use bagrap\Pedido;
use bagrap\Paquete;
use bagrap\Archivo;
use Illuminate\Http\Request;
use bagrap\Cupon_Producto_Pedido;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use bagrap\Http\Requests\CheckoutRequest;
use bagrap\Http\Requests\CouponRequest;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use Carbon\Carbon;

class CouponController extends Controller
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
		$this->authorize('index', Coupon::class);
        $cupones = Coupon::all();

        return view('cupones.index', [
            'cupones' => $cupones
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$this->authorize('create', Coupon::class);

        return view('cupones.create', [
            'cupon' => new Coupon(),
            'fecha' => Carbon::now()
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouponRequest $request)
    {
		$this->authorize('create', Coupon::class);

        $cupon = new Coupon();

        $cupon->codigo = $request->input('cupon_codigo');

        $request->input('tipo_cupon') == 'descuento_porcentaje'  
            ? $cupon->porcentaje_descuento = $request->input('cupon_descuento_porcentaje') 
            : $cupon->valor_descuento = $request->input('cupon_descuento_efectivo');

        $cupon->fecha_inicio = $request->input('date_inicio');
        $cupon->fecha_fin = $request->input('date_vencimiento');
        $cupon->tipo_cupon = $request->input('tipo_cupon');
            
        $cupon->save();

	    return redirect()->to(route('coupon.index'));

    }

    public function edit(Coupon $cupon)
    {
		$this->authorize('create', Coupon::class);

        return view('cupones.create', [
            'cupon' => $cupon,
            'fecha' => Carbon::now()
        ]);

    }

    public function update(Request $request, Coupon $cupon)
    {
        $this->authorize('create', Coupon::class);
        
        $cupon->codigo = $request->input('cupon_codigo');

        $request->input('tipo_cupon') == 'descuento_porcentaje'  
            ? $cupon->porcentaje_descuento = $request->input('cupon_descuento_porcentaje') 
            : $cupon->valor_descuento = $request->input('cupon_descuento_efectivo');

        $cupon->fecha_inicio = $request->input('date_inicio');
        $cupon->fecha_fin = $request->input('date_vencimiento');
        $cupon->tipo_cupon = $request->input('tipo_cupon');
            
        $cupon->save();

        return redirect()->to(route('coupon.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$this->authorize('create', Coupon::class);

        $cupon = Coupon::findOrFail($id);

        $cupon->delete($cupon->id);

        return redirect()->route('coupon.index');
    }


    public function apply(Request $request)
    {

        $cupon = Coupon::where('codigo', '=', $request->input('codigo_cupon'))->first();

        if (!$cupon || $cupon->vigencia($cupon)) {

        	return redirect()->to(url()->previous())->with('errors_coupon', 'Cupón no válido');

        }

        $request->session()->put('cupon', [
            'nombre' => $cupon->codigo,
            'descuento' => $cupon->descuento(Cart::subtotal()),
        ]);

		return redirect()->to(url()->previous())->with('success_coupon', 'Cupón aplicado con éxito');

    }

    public function remove()
    {
        session()->forget('cupon');

		return redirect()->to(url()->previous())->with('success_coupon', 'Cupón removido');

    }



}
