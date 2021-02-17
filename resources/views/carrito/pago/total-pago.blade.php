@extends('layouts.app')

@section('scripts')
<script>
  $(document).ready(function() {
    
    $('#btn-completar').on('click', function(event) {
      event.preventDefault();
      
      $('#btn-completar').prop('disabled', true);
      $('#total-form').submit();
      
    });
  });
  
</script>
@endsection

@section('content')

@if (session('success_coupon'))
<div class='alert alert-info' role='alert'>
  {{ session('success_coupon') }}
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
@elseif (session('errors_coupon'))
<div class='alert alert-danger' role='alert'>
  {{ session('errors_coupon') }}
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
@endif

<section id="clients" class="payment-step mx-auto my-5">
  
  <div class="section-header">
    <h4 class="ml-5">Información del pedido</h4>
  </div>
  
  <div class="row justify-content-center mt-5 mb-4">
    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
      <i class="ion-cash payment-step-icon"></i>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
      <p class="payment-step-paragraph">Información de tu pedido. Antes de aplicar el cargo a tu tarjeta, puedes aplicar un cupón de descuento si cuentas con uno.</p> 
    </div>
  </div>
  
  {{-- <section id="clients"> --}}
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="form">
          <div class="table-responsive">
            <table class="table table-bb">
              <thead>
                <th style="width:10%;"></th>
                <th class="align-middle text-center" scope="col">Producto</th>
                <th class="align-middle text-center" scope="col">Cantidad</th>
                <th class="align-middle text-center" scope="col">Base/Cuadro</th>
                <th class="align-middle text-center" scope="col">Medida</th>
                <th class="align-middle text-center" scope="col">Total</th>
              </thead>
              <tbody>

                @php
                  $productos_session = session()->get('productos');
                @endphp

                @foreach ($carrito as $row)
                <tr>
                  <td class="align-middle text-center"><img src="{!! asset('images/productos') !!}/{{ $row->options['imagen_paquete'] }}" alt=""></td>
                  <td class="align-middle text-center">{{ $row->name }}</td>
                  <td class="align-middle text-center">{{ $productos_session['cantidades'][0][$loop->index]['cantidad'] }}</td>
                  <td class="align-middle text-center">{{ $row->options->base }}</td>
                  <td class="align-middle text-center">{{ $row->options->medida }}</td>
                  <td class="align-middle text-center">${{ $row->total }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      
      <div class="col-md-4 text-center">
        <h3>Subtotal: <span>{{ session()->has('cupon') ? '$' . $nuevoSubtotal : '$' . Cart::subtotal() }}</span></h3>
        <h3>IVA: <span>{{ session()->has('cupon') ? '$' . $newTax : '$' . Cart::tax() }}</span></h3>
        <h3>Envio: <span>$0.00</span></h3>
        <hr>
        
        @if (session()->has('cupon'))
        <h3 class="mb-5" style="display:inline;">Cupón ({{ session()->get('cupon')['nombre'] }}):</h3>
        <form style="display:inline;" action="{{ route('coupon.remove') }}" method="POST">
          @csrf
          @method("DELETE")
          <button style="font-size:70%;margin-bottom:5px;" class="btn-edit" type="submit">Quitar</button>
        </form>
        <h3 class="payment-step-paragraph">Descuento: <span id="descuento_cupon"> -${{ $descuento }}</span></h3>
        {{-- <h3>Nuevo subtotal: <span id="nuevoSubtotal"> ${{ $nuevoSubtotal }}</span></h3> --}}
        {{-- <h3>Nuevos impuestos: <span id="nuevoTax"> ${{ $newTax }}</span></h3> --}}
        <hr>
        @else
        <h3>¿Tienes un cupón?</h3>
        <section id="contact">
          <form action="{{ route('coupon.apply') }}" class="text-center" method="POST">
            @csrf
            <div class="form-group text-center">
              <input type="text" name="codigo_cupon">
              <button class="btn-sec" type="submit">Aplicar</button>
            </div>
          </form>
        </section>
        @endif
        
        <h3 class="pb-4">Total: <span> ${{ $nuevoTotal }}</span></h3>
        
      </div>
      
    </div>
    
    <div class="row float-right">
      <div class="col-md-12">
        <form id="total-form" action="{!! route('pago.total-post') !!}" method="post">
          @csrf
          <a href="{!! route('pago.direccion') !!}" class="previous btn-back">Anterior</a>
          <button id="btn-completar" type="button" class="next btn-edit">Confirmar</button>
        </form>
      </div>
    </div>
    {{-- </section> --}}
    
    
  </section>
  @endsection
  