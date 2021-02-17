@extends('layouts.app')
@section('content')

{{-- {{ dd($charge) }} --}}
@if (session('errors'))
  <div class="container alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
      <p>{{ $error }}</p>
    @endforeach
  </div>
@endif

<section id="clients">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 justify-content-center">
          <div class="section-header">
            <h4>Reembolso - Pedido {{ $pedido->id }}</h4>
          </div>
        </div>
      </div>
    </div>
  
    <div class="row container">
  
      <div class="col-lg-11 justify-content-center mx-auto">
        <div class="row">
          <div class="col-md-6">
            <div style="margin-bottom:10px;" class="section-header">
                <h5 class="title-xs">Información del pedido</h5>
              </div>
              <div class="info-pedido">
                <p><span>Pedido a nombre:</span> {{ $pedido->pedido_nombre }}</p>
                <p><span>Email:</span> {{ $pedido->pedido_email }}</p>
                <p><span>Creación del pedido:</span> {{ $pedido->created_at->format('d-F-y') }}</p>
                <p><span>Estado del pedido:</span> {{ $pedido->error }}</p>
              </div>
          </div>
          <div class="col-md-6">
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
        
        <hr>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-5"></div>
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
                <p><span>Precio: </span>${{ $paquete->precio }}</p>
                <p><span>Cantidad: </span>{{ $paquete->pivot->cantidad }}</p>
                @if($paquete->entregable)
                  <p><span>Dirección de envio: </span>{{ $paquete->pivot->pedido_ciudad.", ".$paquete->pivot->pedido_estado.", C.P. ".$paquete->pivot->pedido_codigo_postal.", Col. ".$paquete->pivot->pedido_colonia.", ".$paquete->pivot->pedido_direccion }}</p>
                  <p><span>Referencia del lugar: </span>{{ $paquete->pivot->comentario }}</p>
                @endif  
              </div>
            </div>
            <hr>
          @endforeach
        </div>
  
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-md-8">
        <form id="create-card-form" action="{!! route('pedido.refund', [ 'customer_id' => $charge->customer_id, 'transaction_id' => $charge->id]) !!}" method="post">
          {{ csrf_field() }}

          <input type="hidden" name="amount_refund" id="amount_refund" value="{{ $charge->serializableData['amount'] }}"/>
          
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="description_refund">Causa del reembolzo *</label>
                <textarea id="description_refund" class="form-control" name="description_refund"></textarea>              
              </div>
            </div>
          </div>

          <div class="float-right">
            <div class="row">
              <div class="col-lg-12 justify-content-center">            
                <a href="{!! route('pedidos.index') !!}" class="btn-sec">Regresar</a>
                <button id="createCardBtn" class="btn-back" type="submit">Reembolsar</button>
              </div>
            </div>
          </div>

        </form>
      </div>   
    </div>  
  
  </section>

@endsection
