<?php

namespace bagrap\Http\Controllers;

use bagrap\Ginecologo;
use Illuminate\Http\Request;
use bagrap\Http\Requests\GinecologoRequest;

class GinecologoController extends Controller
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
        $ginecologos = Ginecologo::where('id', '>', 0)->simplePaginate(1);
        return view('ginecologos.index', [
          'ginecologos' => $ginecologos
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->authorize('create', Ginecologo::class);

        return view('ginecologos.create', [
          'ginecologo' => new Ginecologo()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GinecologoRequest $request)
    {
      $this->authorize('create', Ginecologo::class);

        // Se crea un objeto del modelo ginecologo
        $ginecologo = new Ginecologo();

        $ginecologo = Ginecologo::create([
          'nombre'    => $request->ginecologo['nombre'],
          'ap_pa'     => $request->ginecologo['ap_pa'],
          'ap_ma'     => $request->ginecologo['ap_ma'],
          'estado'    => $request->ginecologo['estado'],
          'municipio' => $request->ginecologo['municipio'],
          'direccion' => $request->ginecologo['direccion'],
          'telefono'  => $request->ginecologo['telefono'],
        ]);

        return redirect()->route('ginecologo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Ginecologo  $ginecologo
     * @return \Illuminate\Http\Response
     */
    public function show(Ginecologo $ginecologo)
    {
      $this->authorize('show', Ginecologo::class);

        return view('ginecologos.show', [
          'ginecologo' => $ginecologo
        ]);
        // return $ginecologo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Ginecologo  $ginecologo
     * @return \Illuminate\Http\Response
     */
    public function edit(Ginecologo $ginecologo)
    {
      $this->authorize('update', Ginecologo::class);

        return view('ginecologos.create', [
          'ginecologo' => $ginecologo
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Ginecologo  $ginecologo
     * @return \Illuminate\Http\Response
     */
    public function update(GinecologoRequest $request, Ginecologo $ginecologo)
    {
      $this->authorize('update', Ginecologo::class);

        $ginecologo->update([
          'nombre'    => $request->ginecologo['nombre'],
          'ap_pa'     => $request->ginecologo['ap_pa'],
          'ap_ma'     => $request->ginecologo['ap_ma'],
          'estado'    => $request->ginecologo['estado'],
          'municipio' => $request->ginecologo['municipio'],
          'direccion' => $request->ginecologo['direccion'],
          'telefono'  => $request->ginecologo['telefono'],
        ]);

        return redirect()->route('ginecologo.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Ginecologo  $ginecologo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ginecologo $ginecologo)
    {
      $this->authorize('delete', Ginecologo::class);

        $ginecologo->delete($ginecologo->id);

        return redirect()->route('ginecologo.index');
    }
}
