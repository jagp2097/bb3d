<?php
namespace bagrap\Http\Controllers;

use bagrap\User;
use bagrap\Archivo;
use bagrap\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use bagrap\Http\Requests\ArchivoRequest;

class ArchivoController extends Controller
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
        $this->authorize('index', Archivo::class);
        $archivos = User::find(Auth::id())->archivos;
        $albumes = User::find(Auth::id())->albums;

        // return $archivos->where('subido_cliente', '=', 0);

        return view('archivos.index', [
      // 'archivos' => $archivos->where('subido_cliente', '=', 0),
            'archivos' => $archivos,
            'albumes'  => $albumes,
        ]);

        //return $albumes;
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        // return view('archivos.create', [
        //     'archivo' => new Archivo()
        // ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(ArchivoRequest $request)
    {

      $this->authorize('create', Archivo::class);
        $user = User::find(Auth::id());
        $archivo = new Archivo();

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $referencia = time().$archivo->getClientOriginalName();
            $archivo->move(public_path().'/images/archivos_cliente', $referencia);

            $archivo = $user->archivos()->create([
                'nombre_archivo' => $archivo->nombre_archivo = $request->input('nombre_archivo'),
                'referencia'     => $referencia,
                'subido_cliente' => true
            ]);

            return redirect()->route('archivo.index')->with('status', 'Se subió');
        }

        else {
            return redirect()->route('archivo.index')->with('status', 'No se subió');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function show(Archivo $archivo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function edit(Archivo $archivo)
    {
        // return view('archivos.create', [
        //     'archivo' => $archivo
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(ArchivoRequest $request, Archivo $archivo)
    {
      $this->autorize('update', $archivo);
        $user = User::find(Auth::id());

        $archivo->nombre_archivo = $request->input('nombre_archivo');
        $archivo->user()->associate($archivo);
        $archivo->save();

        return redirect()->route('archivo.index');

    }

    public function moveTo(Request $request)
    {
        $album = Album::find($request->input('album'));
        $archivo = Archivo::find($request->input('archivo_id'));

        if ($album == 'sin_album') {
            $archivo->album()->dissociate($album);
            $archivo->save();
        } else {
            $archivo->album()->associate($album);
            $archivo->save();
        }

        return redirect()->route('archivo.index');
    }

    public function download(Request $request, $archivo)
    {      
      $archivo = Archivo::findOrFail($archivo);
      
      $this->authorize('download', $archivo);
      
      $path = public_path('images/archivos_cliente/').$archivo->referencia;

      return response()->download($path);
    }

    public function stl_model($model)
    {
      $modelo = Archivo::where('referencia', 'like', "%$model%")->firstOrFail();
      $this->authorize('show', $modelo);

      return view('stl-viewer.modelo', [
        'model' => $modelo
      ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Archivo $archivo)
    {
      $this->authorize('delete', $archivo);
        $user = User::find(Auth::id());

        if ($archivo->album_id != null) {
            $album = Album::find($archivo->album_id);
            $archivo->album()->dissociate($album);
        }

        $ruta_imagen = public_path()."/images/archivos_cliente".$archivo->referencia;
        if (file_exists($ruta_imagen)) { 
          
          // unlink($ruta_imagen);
          File::delete($ruta_imagen); 
        
        }

        $archivo->user()->dissociate($user);

        $archivo->delete($archivo->id);

        return redirect()->route('archivo.index');
    }


}