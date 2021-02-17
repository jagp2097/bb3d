<?php

namespace bagrap\Http\Controllers;

use bagrap\Compra;
use bagrap\Venta;
use bagrap\Paquete;
use bagrap\Archivo;
use bagrap\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
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
      $this->authorize('index', Compra::class);
        $compras = Pedido::where('user_id', '=', Auth::id())->orderBy('created_at', 'desc')->simplePaginate(7);

        return view('compras.index', [
          'compras' => $compras
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('compras.form-compra', [
        //     'compra' => new Compra()
        // ]);
    }

    public function compra($id)
    {
        // $paquete = Paquete::find($id);
        // return view('compras.form-compra', [
        //     'paquete' => $paquete
        // ]);
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
     * @param  \bagrap\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $compra = Pedido::findOrFail($id);
      $archivo = new Archivo();
      $this->authorize('verPedido', Pedido::findOrFail($id));
        return view('compras.show', [
          'compra' => $compra,
          'archivo' => $archivo,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra $compra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compra $compra)
    {
        //
    }
}
