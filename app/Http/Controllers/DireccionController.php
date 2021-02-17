<?php

namespace bagrap\Http\Controllers;

use bagrap\Direccion;
use bagrap\User;
use Illuminate\Http\Request;
use bagrap\Http\Requests\DireccionRequest;
use Illuminate\Support\Facades\Auth;

class DireccionController extends Controller
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
		$this->authorize('index', Direccion::class);
        // return Direccion::where('user_id', '=', Auth::id())->get();
        return view('direcciones.index', [
            'direcciones' => Direccion::where('user_id', '=', Auth::id())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$this->authorize('create', Direccion::class);
        return view('direcciones.create', [
            'direccion' => new Direccion()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DireccionRequest $request)
    {
		$this->authorize('create', Direccion::class);
        $direccion = new Direccion();

        $direccion::create([
            'user_id' => Auth::id(),
            'calle' => $request->input('direccion_calle'),
            'numero' => $request->input('direccion_numero'),
            'codigo_postal' => $request->input('direccion_codigo_postal'),
            'colonia' => $request->input('direccion_colonia'),
            'localidad' => $request->input('direccion_ciudad'),
            'estado' => $request->input('direccion_estado'),
            'pais' => $request->input('direccion_pais'),
            'referencias' => $request->input('direccion_referencias'),
        ]);

        return redirect()->to(route('direccion.index'))->with('status', "Dirección de envio añadida con éxito");

    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show(Direccion $direccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function edit(Direccion $direccion)
    {
		$this->authorize('update', Direccion::class);

        return view('direcciones.create', [
            'direccion' => $direccion
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function update(DireccionRequest $request, Direccion $direccion)
    {
		$this->authorize('update', Direccion::class);

        $direccion->update([
            'user_id' => Auth::id(),
            'calle' => $request->input('direccion_calle'),
            'numero' => $request->input('direccion_numero'),
            'codigo_postal' => $request->input('direccion_codigo_postal'),
            'colonia' => $request->input('direccion_colonia'),
            'localidad' => $request->input('direccion_ciudad'),
            'estado' => $request->input('direccion_estado'),
            'pais' => $request->input('direccion_pais'),
            'referencias' => $request->input('direccion_referencias'),
        ]);

        return redirect()->route('direccion.index')->with('status', 'Direcció editada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direccion $direccion)
    {
		$this->authorize('delete', Direccion::class);

        $user = User::find(Auth::id());
        $direccion->user()->dissociate($user);

        $direccion->delete($direccion->id);
        return redirect()->route('direccion.index');
    }
}
