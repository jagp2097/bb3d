{{-- Mis compras - Usuario --}}
@extends('layouts.app')
@section('content')

<section id="clients">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 justify-content-center">
          <div class="section-header">
            <h4>Pedido {{ $compra->id }}</h4>
          </div>
        </div>
      </div>
    </div>
  
    <div class="row container">
  
      <div class="col-lg-11 justify-content-center mx-auto">
        <div style="margin-bottom:10px;" class="section-header">
          <h5 class="title-xs">Información del cargo</h5>
        </div>
        <div class="info-pedido">
          <p class="payment-step-paragraph"><strong>Pedido hecho por:</strong> {{ $compra->pedido_nombre }}</p>
          <p class="payment-step-paragraph"><strong>Nombre en la tarjeta:</strong> {{ $compra->pedido_nombre_en_tarjeta }}</p>
          <p class="payment-step-paragraph"><strong>Estado de la transacción: </strong>{{ $compra->error }}</p>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-5"></div>
          <div class="col-md-3 text-center">
            <div class="section-header">
              <h5 class="title-xs">Archivo cargado</h5>
            </div>
          </div>
        </div>
        <div class="info-pedido">
          @foreach ($compra->paquetes as $paquete)
            <div class="row">
              <div class="col-md-3 my-auto text-center">
                <img src="{{ asset('images/productos') }}/{{ $paquete->foto }}" alt="">
              </div>
              <div class="col-md-5 my-auto">
                <p class="payment-step-paragraph"><strong>Paquete: </strong>{{ $paquete->nombre }}</p>
                <p class="payment-step-paragraph"><strong>Descripción: </strong>{{ $paquete->descripcion }}</p>
                {{-- <p class="payment-step-paragraph"><strong>Precio: </strong>${{ $paquete->precio }}</p> --}}
                <p class="payment-step-paragraph"><strong>Cantidad: </strong>{{ $paquete->pivot->cantidad }}</p>
                <p class="payment-step-paragraph"><strong>Medida: </strong>{{ $paquete->pivot->medida }}</p>
                <p class="payment-step-paragraph"><strong>Base: </strong>{{ $paquete->pivot->base }}</p>
                @if($paquete->entregable)
                  <p class="payment-step-paragraph"><strong>Dirección de envio: </strong>{{ $paquete->pivot->pedido_ciudad.", ".$paquete->pivot->pedido_estado.", C.P. ".$paquete->pivot->pedido_codigo_postal.", Col. ".$paquete->pivot->pedido_colonia.", ".$paquete->pivot->pedido_direccion }}</p>
                  <p class="payment-step-paragraph"><strong>Referencia del lugar: </strong>{{ $paquete->pivot->pedido_referencia_direccion }}</p>
                @endif
              </div>
              <div class="col-md-3 my-auto text-center">
                  <p class="payment-step-paragraph">{{ $archivo->where('referencia', '=', $paquete->pivot->archivo)->first()->nombre_archivo }}</p>
              </div>
            </div>
            <hr>
          @endforeach
        </div>
  
        <div class="row text-center">
          <div class="col-md-12 py-5">
            <div style="margin-bottom:10px;" class="section-header">
              <h5 style="margin:0;" class="title-xs">Total</h5>
            </div>
            <div class="info-pedido">
              {{-- <p>Titular de la tarjeta {{ $paquete->pedido_nombre_en_tarjeta }}</p> --}}
              <p class="payment-step-paragraph"><strong>Subtotal:</strong> ${{ $compra->pedido_subtotal }}</p>
              <p class="payment-step-paragraph"><strong>Impuestos:</strong> ${{ $compra->pedido_tax }}</p>
              <p class="payment-step-paragraph"><strong>Total:</strong> ${{ $compra->pedido_total }}</p>
            </div>
  
          </div>
        </div>
  
      </div>
    </div>
  
    <div class="float-right">
      <div class="row pb-5">
        <div class="col-lg-12 justify-content-center">
          <a href="{!! route('compra.index') !!}" class="btn-sec" role="button">Regresar a mis compras</a>
        </div>
      </div>
    </div>
  
  </section>

@endsection
