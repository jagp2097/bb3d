<?php

namespace bagrap\Http\Controllers;

use Cart;
use Gate;
use Session;
use bagrap\Paquete;
use Illuminate\Http\Request;
use bagrap\Http\Requests\PaqueteRequest;

class PaqueteController extends Controller
{

  public function __construct()
  {
        $this->middleware('auth');
        $this->middleware('isActive');
        $this->middleware('admin')->only(['medidas']);
            // $this->middleware('verified');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('paquetes.index', [
            'paquetes' => Paquete::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $this->authorize('create', Paquete::class);

        return view('paquetes.create', [
          'paquete' => new Paquete()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaqueteRequest $request)
    {
        $paquete = new Paquete();

        if ( $request->hasFile('foto') ) {
            $foto = $request->file('foto');
            $referencia = time().$foto->getClientOriginalName();
            $foto->move(public_path().'/images/productos', $referencia);

            $paquete = Paquete::create([
                'nombre'       =>  $request->input('nombre'),
                'descripcion'  =>  $request->input('descripcion'),
                'precio'       =>  $request->input('precio'),
                'publicado'    =>  $request->input('publicado'),
                'foto'         =>  $referencia,
                'entregable'   =>  1,
            ]);

            return redirect()->route('paquete.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function show(Paquete $paquete)
    {
      $this->authorize('show', Paquete::class);
        return view('paquetes.show', [
          'paquete' => $paquete
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Paquete $paquete)
    {
      $this->authorize('update', Paquete::class);

        return view('paquetes.create', [
          'paquete' => $paquete
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function update(PaqueteRequest $request, Paquete $paquete)
    {
      //return $request;
      $this->authorize('update', Paquete::class);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $referencia = time().$foto->getClientOriginalName();
            $foto->move(public_path().'/images/productos', $referencia);

            $paquete->update([
              'nombre'      =>  $request->input('nombre'),
              'descripcion' =>  $request->input('descripcion'),
              'precio'      =>  $request->input('precio'),
              'publicado'   =>  $request->input('publicado'),
              'foto'        =>  $referencia,
              'entregable'  =>  1,
            ]);

            return redirect()->route('paquete.index');
        }

        else {
            $paquete->update($request->except('foto'));

            return redirect()->route('paquete.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paquete $paquete)
    {
      $this->authorize('delete', Paquete::class);
        $paquete->delete($paquete->id);

        return redirect()->route('paquete.index')->with('status', 'Producto eliminado con éxito');
    }

    public function medidas()
    {

        if(Gate::allows('medidas')) {

            session()->forget('productos');

            return view('paquetes.medidas', [
                'productos' => Cart::content()
            ]);

        } else {
            return abort(401, 'This action is unauthorized.');
        }


    }

    public function medidasPost(Request $request)
    {
        
        if(!session()->has('productos')) {
            
            session()->push('productos.medidas', $request->productos_specs);
            
        } else {
            
            session()->push('productos.medidas', $request->productos_specs);

        }

        return response()->json([
            'medidas' => $request->productos_specs,
        ]);       

    }

    public function bases()
    {

        if(Gate::allows('bases')) {
            
            return view('paquetes.bases', [
                'productos' => Cart::content()
            ]);
             
        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }

    public function basesPost(Request $request)
    {

        if(!session()->has('productos')) {

            session()->push('productos.bases', $request->productos_specs);

        } else {
            
            session()->push('productos.bases', $request->productos_specs);

        }

        return response()->json([
            'bases' => $request->productos_specs,
        ]);       

    }

    public function cantidad()
    {  
        if(Gate::allows('cantidad')) {

            return view('paquetes.cantidad', [
                'productos' => Cart::content(),
                'producto' => new Paquete(),
            ]);
            
        } else {
            return abort(401, 'This action is unauthorized.');
        }
    }

    public function cantidadesPost(Request $request) 
    {

        if(!session()->has('productos')) {

            session()->push('productos.cantidades', $request->productos_specs);

        } else {

            session()->push('productos.cantidades', $request->productos_specs);

        }

        return response()->json([
            'cantidades' => $request->productos_specs,
        ]);  

    }

    public function actualizarCarrito()
    {

        if(Gate::allows('actualizarCarrito')) {

            $cont = 0;
            $precio_extra = 0;
            $productos_session = session()->get('productos');
    
            foreach(Cart::content() as $row) {
                
                $precio_extra += $productos_session['medidas'][0][$cont]['precio_extra'];
                $precio_extra += $productos_session['cantidades'][0][$cont]['precio_extra'];
    
                $nuevo_precio = (Paquete::findOrFail($row->id)->precio + $precio_extra) / 1.16; // Sin IVA
    
                Cart::update($row->rowId, [
                    'price' => $nuevo_precio,
                    'options' => [
                        'imagen_paquete' => Paquete::findOrFail($row->id)->foto,
                        'entregable' => Paquete::findOrFail($row->id)->entregable,
                        'medida' =>  $productos_session['medidas'][0][$cont]['medida'],
                        'base' => $productos_session['bases'][0][$cont]['base'],
                        'cantidad_paquete' => $productos_session['cantidades'][0][$cont]['cantidad']
                    ],
                ]);
    
                $cont++;
                $precio_extra = 0;
    
            }             
            
            return redirect()->to(route('cart.content'));

        } else {

            return abort(401, 'This action is unauthorized.');

        }

        
    }

    

}