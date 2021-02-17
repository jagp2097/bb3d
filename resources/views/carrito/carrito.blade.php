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
                  <a class="btn-back" href="{!! route('paquete.index') !!}">Agregar más productos</a>
                  @can('destroyCart')
                  <form style="display: inline;" action="{!! route('cart.destroy') !!}" method="post">
                    {{ csrf_field() }}
                    <button  class="btn-sec" type="submit" name="button">Vaciar carrito</button>
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
        <table class="table">
          <thead class="text-center">
            <th style="color: black; font-size: .95em;" scope="col">Artículo</th>
            <th style="color: black; font-size: .95em;" scope="col"></th>
            <th style="color: black; font-size: .95em;" scope="col">Precio</th>
            <th style="color: black; font-size: .95em;" scope="col">Cantidad</th>
            <th style="color: black; font-size: .95em;" scope="col">Subtotal</th>
            <th style="color: black; font-size: .95em;" scope="col">IVA</th>
            <th style="color: black; font-size: .95em;" scope="col">Total</th>
            <th style="color: black; font-size: .95em;" scope="col"></th>
          </thead>
          <tbody>
            @foreach ($cart_content as $row)
            <tr class="justify-content-center box mt-3">
              <td style="padding:0;" class="align-middle text-center">
                <img style="width: 70%" src="{{ asset('images/productos') }}/{{ $row->options->imagen_paquete }}" alt="">
              </td>

              <td class="align-middle text-center">
                {{ $row->name }}
              </td>
              
              <td class="align-middle text-center">${{ $row->price }}</td>
              
              <td class="align-middle text-center">
                @can('updateItem')
                <input class="qty" type="number" value="{{ $row->qty }}" min="1" data-rowid="{{ $row->rowId }}" data-paqueteid="{{$row->id}}">
                @endcan
              </td>
              
              <td class="align-middle text-center">${{ $row->subtotal }}</td>
              
              <td class="align-middle text-center">${{ $row->tax * $row->qty }}</td>
              
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
      <a href="{!! route('pago.direccion') !!}" class="btn-edit">Pagar</a>
    </div>
    
  </div>
</section>


@section('scripts')
<script type="text/javascript">
  $(document).ready(function() {
    
    var qty_input = document.getElementsByClassName('qty');
    
    Array.from(qty_input).forEach(function(element) {
      element.addEventListener('change', function(){
        var paqueteId = element.getAttribute('data-paqueteid');
        var ruta = "{!! route('cart.content') !!}";
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $("input[name='_token']").val(),
          }
        });
        
        $.ajax({
          url: ruta+'/'+paqueteId,
          type: 'PUT',
          dataType: 'json',
          data: {
            rowId : element.getAttribute('data-rowid'),
            new_qty : element.value,
          },
          success: function(data) {
            console.log(data);
            window.location.href = "{!! route('cart.content') !!}";
          },
          error: function(e) {
            console.log(e);
            // console.log('no funcionó');
          }
        });
      });
    });
    
    
  });
  
</script>
@endsection

@endif


@endsection
