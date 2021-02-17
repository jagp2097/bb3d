@extends('layouts.app')
@section('content')

@if (session('status'))
<div class="alert alert-info" role="alert">
  {{ session('status') }}
</div>
@endif

<section id="contact">
  <div class="container">
    <div class="section-header">
      
      <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6">
          <h4>Productos</h4>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 text-right">
          <div class="row">
            <div class="col-lg-12 justify-content-center">
              <a href="{{ route('perfil.show') }}" class="btn-sec" role="button"> Perfil </a>
              @can('medidas')
              <a href="{{ route('paquete.medidas') }}" class="btn-back" role="button"> Selecciona la medida de tu Bb3D </a>            
              @endcan
              @can('create', bagrap\Paquete::class)
              <a href="{{ route('paquete.create') }}" class="btn-back" role="button">Crear paquete</a>            
              @endcan
              {{-- @can('canjear', bagrap\Coupon::class) --}}
              {{-- <a href="{{ route('coupon.canjear') }}" class="btn-edit" role="button">¿Compraste por adelantado?</a>             --}}
              {{-- @endcan --}}
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<section id="productos" class="products-bb3d" style="padding:0 25px;">
  <div class="row">
    @foreach ($paquetes as $paquete)
      <div class="col-md-4">
          <div class="box">
              <img src="{{ asset('images/productos') }}/{{ $paquete->foto }}" alt="producto imagen">
              <p class="product-price">${{ $paquete->precio }} <small>c/u</small></p>
              <h3 class="product-title">{{ $paquete->nombre }}</h3>
              <p class="product-paragraph">{{ $paquete->descripcion }}</p>
              @if (Auth::user()->role_id == 1)
                <p class="product-paragraph">Publicado en la página: {{ $paquete->publicado ? 'Si' : 'No' }}</p>
                {{-- <p>¿Enviable? : {{ $paquete->entregable ? 'Si' : 'No' }}</p> --}}
              @endif

              <div class="product-buttons text-center">
                @can('addToCart')
                  {{-- <a href="{{ route('paquete.medidas') }}" class="btn-back" role="button">Medidas</a> --}}

                  <form class="mt-2" action="{!! route('cart.add', $paquete) !!}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="paquete_id" value="{{ $paquete->id }}">
                    <input type="hidden" name="paquete_nombre" value="{{ $paquete->nombre }}">
                    <input type="hidden" name="paquete_precio" value="{{ $paquete->precio }}">
                    <button class="btn-back" type="submit">Añadir al carrito</button>
                  </form>
                @endcan

                @can('update', $paquete)
                  <form action="{{ route('paquete.edit', $paquete->id) }}" style="display:inline">
                    @csrf
                    <button type="submit" class="btn-edit mt-2">Editar</button>
                  </form>              
                @endcan
                
                {{-- @can('delete', $paquete)
                <form action="{{ route('paquete.destroy', $paquete->id) }}" style="display:inline" method="POST">
                  @method("DELETE")
                  @csrf
                  <button type="submit" class="btn-del mt-2">Eliminar</button>
                </form>
                @endcan --}}
              </div>

          </div>
      </div>
    @endforeach
  </div>
</section>
    


@endsection
