<?php

namespace bagrap\Http\Controllers;

use bagrap\Profile;
use bagrap\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use bagrap\Http\Requests\PerfilRequest;


class ProfileController extends Controller
{

  public function __construct()
  {
    
    $this->middleware('auth');
    $this->middleware('isActive')->except(['recover', 'recoverAccount']);
    // $this->middleware('verified');

  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \bagrap\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $profile = Profile::where('user_id', '=', Auth::id())->first();
        return view('auth.profiles.show', [
          'perfil' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $profile = Profile::where('user_id', '=', Auth::id())->first();
        $user = User::where('id', '=', Auth::id())->first();

        return view('auth.profiles.edit', [
          'perfil' => $profile,
          'user'   => $user,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(PerfilRequest $request, Profile $profile, $user_id)
    {
      // return $request->user() ? 'si' : 'no';
      $profile = Profile::where('user_id', '=', Auth::id())->first();
      $user = User::where('id', '=', $user_id)->first();

      if ($request->hasFile('perfil_foto')) {

          $imagen_perfil = $request->file('perfil_foto');
          $referencia = time().$imagen_perfil->getClientOriginalName();
          $imagen_perfil->move(public_path().'/images/perfil_fotos', $referencia);

          $profile->update([
            'nombre'           =>  $request->input('perfil_nombre'),
            'apellidos'        =>  $request->input('perfil_apellidos'),
            'fecha_nacimiento' =>  $request->input('perfil_nacimiento'),
            'pais_origen'      =>  $request->input('perfil_pais_origen'),
            'telefono'         =>  $request->input('perfil_telefono'),
            'foto'             =>  $referencia,
          ]);

      } else {

        $profile->update([
          'nombre'           =>  $request->input('perfil_nombre'),
          'apellidos'        =>  $request->input('perfil_apellidos'),
          'fecha_nacimiento' =>  $request->input('perfil_nacimiento'),
          'pais_origen'      =>  $request->input('perfil_pais_origen'),
          'telefono'         =>  $request->input('perfil_telefono'),
        ]);

      }

      $user->update([
        'email' => $request->input('perfil_correo'),
      ]);

      return redirect()->route('perfil.show');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy($profile_id)
    {

      $profile = Profile::findOrFail($profile_id);
      $user = $profile->user;

      $user->perfil()->delete($user->id);
      $user->delete($user->id);
        
      return redirect()->to(url('/'));

    }

    public function recover()
    {
      return view('auth.profiles.recover');
    }

    public function recoverAccount(Request $request)
    {
      
      $user = Auth::user();

      $user->update([
        'is_active' => 1,
      ]);

      return redirect()->to(route('perfil.show'))->with('status', 'Tu cuenta ha sido reactivada.');

    }

}
