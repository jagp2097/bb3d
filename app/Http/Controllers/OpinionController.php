<?php

namespace bagrap\Http\Controllers;

use bagrap\Opinion;
use bagrap\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class OpinionController extends Controller
{

    use AuthenticatesUsers;

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
        $this->authorize('index', Opinion::class);
        $opiniones = Opinion::where('id', '>', '0')->simplePaginate(7);
        
        return view('opinion.index', [
            'opiniones' => $opiniones
        ]); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('opinion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth::user();

        if ($request->filled('opinion')) {

            $opinion = new Opinion();
    
            $opinion->email = Auth::user()->email;
            $opinion->nombre = Auth::user()->perfil->fullname;
            $opinion->opinion = $request->input('opinion');
    
            $opinion->save();
               
        }

        $user->update([
            'is_active' => 0
        ]);

        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function show(Opinion $opinion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function edit(Opinion $opinion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opinion $opinion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Opinion  $opinion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opinion $opinion)
    {
        $opinion->destroy($opinion->id);

        return redirect()->to(route('opinion.index'));
    }
}
