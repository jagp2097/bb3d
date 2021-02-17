<?php

namespace bagrap\Http\Controllers;

use Illuminate\Http\Request;
use bagrap\Paquete;
use bagrap\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return view('layouts.guest', [
            'paquetes' => Paquete::all(),
            'posts' => Post::all()->sortByDesc('created_at')->take(3),
        ]);
    }
}
