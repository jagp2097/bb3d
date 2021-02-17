<?php

namespace bagrap\Http\Controllers;

use bagrap\User;
use bagrap\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('ventas.index', [
        //   'ventas' => Venta::all()
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('ventas.create', [
        //   'venta' => new Venta()
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
        // $venta = new Venta();
        //
        // $venta = Venta::create([
        //   'user_id'          => $request->input('user_id'),
        //   'pais'             => $request->input('pais'),
        //   'estado'           => $request->input('estado'),
        //   'ciudad'           => $request->input('ciudad'),
        //   'codigo_postal'    => $request->input('codigo_postal'),
        //   'direccion'        => $request->input('direccion'),
        //   'referencia_lugar' => $request->input('referencia_lugar'),
        // ]);
        //
        // $venta->paquetes()->attach($venta->id);
        //
        // return redirect()->route('ventas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        // return view('ventas.show', [
        //     'venta' => $venta,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        // return view('ventas.create', [
        //   'venta' => $venta
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        // $venta = Venta::update([
        //   'pais'             => $request->input('pais'),
        //   'estado'           => $request->input('estado'),
        //   'ciudad'           => $request->input('ciudad'),
        //   'codigo_postal'    => $request->input('codigo_postal'),
        //   'direccion'        => $request->input('direccion'),
        //   'referencia_lugar' => $request->input('referencia_lugar'),
        // ]);
        //
        // $venta->paquetes()->sync([$venta->id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        // $venta->paquetes()->detach($venta->id);
        //
        // $venta->delete($venta->id);
        //
        // return redirect()->route('venta.index');
    }
}
