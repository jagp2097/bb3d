<?php

namespace bagrap\Http\Controllers;

use bagrap\User;
use bagrap\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use bagrap\Http\Requests\AlbumRequest;

class AlbumController extends Controller
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
        $albums = User::find(Auth::id())->albums;
        return view('albums.index', [
          'albums' => $albums
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('albums.create', [
        //   'album' => new Album()
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
      $this->authorize('create', Album::class);
        $user = User::find(Auth::id());
        $album = new Album();

        $album = $user->albums()->create([
          'nombre_album' => $request->input('nombre_album'),
          'descripcion'  => $request->input('descripcion'),
        ]);

        return redirect()->route('archivo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
      $this->authorize('show', $album);
        $albumes = User::find(Auth::id())->albums;
        return view('albums.show', [
          'album' => $album,
          'albumes' => $albumes,
        ]);
        //return $albumes;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        // return view('albums.create', [
        //   'album' => $album
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, Album $album)
    {
      $this->authorize('update', $album);
        $user = User::find(Auth::id());

        $album->nombre_album = $request->input('nombre_album');
        $album->descripcion  = $request->input('descripcion');

        $album->user()->associate($user);
        $album->save();

        return redirect()->route('album.show', $album->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
      $this->authorize('delete', $album);
        $user = User::find(Auth::id());
        $album->user()->dissociate($user);

        $album->delete($album->id);

        return redirect()->route('archivo.index');
    }
}
