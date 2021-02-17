@extends('layouts.app')
@section('content')

@if (Cart::count() == 0)

<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <div class="text-center mt-5 mb-3" style="height:100vh;">
          
          <div class="section-header">
            <h3 style="font-size:3.6em;color:#1d99bf">Su carrito esta vacío</h3>
          </div>
          
          <div class="text-center mt-2 mb-3">
            <label style="font-size:7.5em">
              <i class="ion-ios-cart-outline"></i>
            </label>
          </div>
          
          <div class="text-center mt-3">
            <a class="btn-back" href="{!! route('paquete.index') !!}">Agregar productos</a>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</section>

@else
<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <div class="section-header">
          
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <h4>Carrito</h4>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-right">
              <div class="row">
                <div class="col-lg-12 justify-content-center">
                  <a class="btn-sec" href="{!! route('paquete.index') !!}">Agregar más productos</a>
                  @can('destroyCart')
                  <form style="display: inline;" action="{!! route('cart.destroy') !!}" method="post">
                    {{ csrf_field() }}
                    <button  class="btn-del" type="submit" name="button">Vaciar carrito</button>
                  </form>
                  @endcan
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section id="contact">
      <div class="table-responsive">
        <table class="table table-bb">
          <thead class="text-center">
            <tr>
              <th scope="col"><strong>Artículo</strong></th>
              <th scope="col"></th>
              <th scope="col"><strong>Cantidad</strong></th>
              <th scope="col"><strong>Base/Cuadro</strong></th>
              <th scope="col"><strong>Medida</strong></th>
              <th scope="col"><strong>Total</strong></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>

            @php
                $productos_session = session()->get('productos');
            @endphp

            @foreach ($cart_content as $row)
            <tr class="justify-content-center mt-3">
              <td class="align-middle text-center ta-img">
                <img src="{{ asset('images/productos') }}/{{ $row->options->imagen_paquete }}" alt="">
              </td>

              <td class="align-middle text-center">
                {{ $row->name }}
              </td>
              
              <td class="align-middle text-center">{{ $productos_session['cantidades'][0][$loop->index]['cantidad'] }}</td>
              
              <td class="align-middle text-center">{{ $row->options->base }}</td>
              
              <td class="align-middle text-center">{{ $row->options->medida }}</td>
              
              <td class="align-middle text-center">${{ $row->total }}</td>
              
              <td class="align-middle text-center">
                @can('removeItem')
                <form class="" action="{!! route('cart.removeItem', $row->rowId) !!}" method="post">
                  {{ csrf_field() }}
                  @method('DELETE')
                  <button class="btn-del" type="submit">Eliminar</button>
                </form>
                @endcan
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>
    
    <div class="text-right m-2">
        @can('updateItem')
          <a href="{{ route('paquete.medidas') }}" class="btn-back" role="button">Modificar productos</a>    
          {{-- <input class="qty" type="number" value="{{ $row->qty }}" min="1" data-rowid="{{ $row->rowId }}" data-paqueteid="{{$row->id}}"> --}}
        @endcan
      <a href="{!! route('pago.direccion') !!}" class="btn-edit">Pagar</a>
    </div>
    
  </div>
</section>

@endif


@endsection
