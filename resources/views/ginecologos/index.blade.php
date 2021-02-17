@extends('layouts.app')
@section('content')

<section id="team" class="wow">
  <div class="container">
    <div class="section-header">
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
          <h4>Ginecólogos</h4>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 text-right">
          <div class="row">
            <div class="col-lg-12 justify-content-center">
              @can ('create', bagrap\Ginecologo::class)
              <a href="{{ route('ginecologo.create') }}" class="btn-back" role="button">Añádir ginecólogo</a>
              @endcan
              <a href="{{ route('perfil.show') }}" class="btn-sec" role="button">Perfil</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      @foreach ($ginecologos as $ginecologo)
      @can ('show', bagrap\Ginecologo::class)
      <div style="cursor:pointer;" onclick="window.location = '{!! route('ginecologo.show', $ginecologo->id) !!}'" class="col-lg-3 col-md-6 col-sm-6">
        <div class="member">
          <div class="pic">
            <img src="{{ asset('images/archivos_cliente/default.png') }}" alt="">
          </div>
          <div class="details">
            <h4>{{ $ginecologo->fullname }}</h4>
            <span>Teléfono: {{ $ginecologo->telefono }}</span>
            <h2>Estado: {{ $ginecologo->estado }}</h2>
            <h2>Municipio: {{ $ginecologo->municipio }}</h2>
            <h2 class="tb-2">Dirección: {{ $ginecologo->direccion }}</h2>
            {{-- <h2>Creado: { $perfil->created_at->diffForHumans() }</h2> --}}
            <div class="m-2">
              @can ('update', bagrap\Ginecologo::class)
              <a class="btn-edit" role="button" href="{{ route('ginecologo.edit', $ginecologo->id) }}">Editar</a>
              @endcan
              @can ('delete', bagrap\Ginecologo::class)
              <form class="m-2" action="{{ route('ginecologo.destroy', $ginecologo->id) }}" method="post">
                {{ csrf_field() }}
                @method('DELETE')
                <button class="btn-del" type="submit" name="button">Eliminar</button>
              </form>
              @endcan
            </div>
          </div>
        </div>
      </div>
      @endcan
      @endforeach
    </div>
    
  </div>
</section>

@endsection
