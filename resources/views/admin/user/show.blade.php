@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            {{ $user->email }}
            {{ $user->role['name'] }}
        </div>
        <div class="row">
            {{ $user->perfil->nombre }}
            {{ $user->perfil->ap_pa }}
            {{ $user->perfil->ap_pa }}
            {{ $user->perfil->fecha_nacimiento }}
            {{ $user->perfil->pais_origen }}
            {{ $user->perfil->estado }}
            {{ $user->perfil->ciudad }}
            {{ $user->perfil->direccion }}
        </div>
        <div class="row">
            @foreach ($user->albums as $album)
                {{ $album->nombre_album }}
                {{ $album->descripcion }}
                {{ $album->count() }}
            @endforeach
        </div>
        <div class="row">
            @foreach ($user->archivos as $archivo)
                {{ $archivo->nombre_archivo }}
                <img style="width:100%;" src="{!! asset('images/') !!}/{{ $archivo->referencia }}" alt="">
            @endforeach
        </div>
    </div>
@endsection
