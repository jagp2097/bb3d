{{-- Pedidos -- Usuario Administrador --}}

@extends('layouts.app')
@section('content')

<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <div class="section-header">
          <h4>Detalles - Pedido {{ $pedido->id }}</h4>
        </div>
      </div>
    </div>
  </div>

  <div class="row container">

    <div class="col-lg-11 justify-content-center mx-auto">
      <div style="margin-bottom:10px;" class="section-header">
        <h5 class="title-xs">Información del pedido</h5>
      </div>
      <div class="info-pedido">
        <p><span>Pedido a nombre:</span> {{ $pedido->pedido_nombre }}</p>
        <p><span>Email:</span> {{ $pedido->pedido_email }}</p>
        <p><span>Creación del pedido:</span> {{ $pedido->created_at->format('d-F-y') }}</p>
        <p><span>Estado del pedido:</span> 
          
          
          @switch($pedido->error)

                @case($pedido->error == 'completed')
                  @if ($pedido->entregado == 0)
                    En proceso          
                    @break
                  @endif

                @case(strpos($pedido->error, 'Reembolso'))
                  @if ($pedido->entregado == 0)
                    Cancelado     
                    @break
                  @endif

                @case($pedido->error == 'completed')
                  @if ($pedido->entregado == 1)
                    Completado          
                    @break
                  @endif

                @case(strpos($pedido->error, 'Cancelado'))
                  Cancelado      
                  @break

                @case(strpos($pedido->error, 'cupon pago por adelantado usado'))
                  En proceso        
                  @break

              @endswitch  
        
        </p>
        {{-- {{ $pedido }} --}}
        {{-- <p><span>Dirección de envio:</span> {{ $pedido->fullAddress }}</p> --}}
        {{-- <p><span>Referencia lugar de envio:</span> {{ $pedido->pedido_referencia_direccion }}</p> --}}
        {{-- <p><span>Télefono:</span> {{ $pedido->pedido_telefono }}</p> --}}
      </div>
      <hr>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-5"></div>
        <div class="col-md-3 text-center">
          <div style="margin-bottom:5px;" class="section-header">
            <h5 class="title-xs">Archivo cargado</h5>
          </div>
        </div>
      </div>
      <div class="info-pedido">
        @foreach ($pedido->paquetes as $paquete)
          <div class="row">
            <div class="col-md-3 my-auto text-center">
              <img src="{{ asset('images/productos') }}/{{ $paquete->foto }}" alt="">
            </div>
            <div class="col-md-5 my-auto">
              <p><span>Paquete: </span>{{ $paquete->nombre }}</p>
              <p><span>Descripción: </span>{{ $paquete->descripcion }}</p>
              <p><span>Cantidad: </span>{{ $paquete->pivot->cantidad }}</p>
              <p><span>Medida: </span>{{ $paquete->pivot->medida }}</p>
              <p><span>Base: </span>{{ $paquete->pivot->base }}</p>
              @if($paquete->entregable)
                <p><span>Dirección de envio: </span>{{ $paquete->pivot->pedido_ciudad.", ".$paquete->pivot->pedido_estado.", C.P. ".$paquete->pivot->pedido_codigo_postal.", Col. ".$paquete->pivot->pedido_colonia.", ".$paquete->pivot->pedido_direccion }}</p>
                <p><span>Referencia del lugar: </span>{{ $paquete->pivot->pedido_referencia_direccion }}</p>
              @endif  
            </div>
            <div class="col-md-3 my-auto text-center">
                {{ $paquete->pivot->archivo }}
              {{-- <img src="{{ asset('images/') }}/{{ $paquete->pivot->archivo }}" alt=""> --}}
            </div>
          </div>
          <hr>
        @endforeach
      </div>

      <div class="row">
        <div class="col-md-12">
          <div style="margin-bottom:10px;" class="section-header">
            <h5 class="title-xs">Total</h5>
          </div>
          <div class="info-pedido">
            {{-- <p>Titular de la tarjeta {{ $pedido->pedido_nombre_en_tarjeta }}</p> --}}
            <p><span>Subtotal:</span> ${{ $pedido->pedido_subtotal }}</p>
            <p><span>Impuestos:</span> ${{ $pedido->pedido_tax }}</p>
            <p><span>Total:</span> ${{ $pedido->pedido_total }}</p>
          </div>

        </div>
      </div>

    </div>
  </div>

  <div class="float-right">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <a href="{!! route('pedidos.index') !!}" class="btn-sec" role="button">Regresar a los pedidos</a>

        @switch($pedido->error)

          @case($pedido->error == 'completed')
            @if ($pedido->entregado == 0)
              <a href="{!! route('pedido.complete', $pedido->id) !!}" class="btn-back" role="button">Completar pedido</a>
              @endif
            @break

            @case($pedido->error == 'cupon pago por adelantado usado')
            @if ($pedido->entregado == 0)
              <a href="{!! route('pedido.complete', $pedido->id) !!}" class="btn-back" role="button">Completar pedido</a>
              @endif
            @break
        
         @endswitch


      </div>
    </div>
  </div>

</section>

@endsection
