@extends('layouts.app')
@section('content')

<section id="clients">
  <div class="container">
    <div class="row">
      
      <div class="col-lg-12 justify-content-center">
        <div class="section-header">
          
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <h4>Pedidos</h4>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 text-right">
                <div class="row">
                  <div class="col-lg-12 justify-content-center">
                    <a href="{!! route('perfil.show') !!}" class="btn-sec">Perfil</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <section id="content">
        <div class="table-responsive">
          <table class="table table-bb">
            <thead class="text-center">
              <th class="text-center align-middle" scope="col">Pedido ID</th>
              <th class="text-center align-middle" scope="col">Pedido a nombre de</th>
              <th class="text-center align-middle" scope="col">Email</th>
              <th class="text-center align-middle" scope="col">Creación del pedido</th>
              <th class="text-center align-middle" scope="col">Estado del pedido</th>
              <th class="text-center align-middle" scope="col">Total</th>
              {{-- <th class="text-center align-middle" scope="col">Estado del pedido</th> --}}
              <th class="text-center align-middle" scope="col"></th>
              <th class="text-center align-middle" scope="col"></th>
            </thead>
            <tbody>
              @foreach($pedidos as $pedido)
              <tr>
                <td class="text-center align-middle">{{ $pedido->id }}</td>
                <td class="text-center align-middle">{{ $pedido->pedido_nombre }}</td>
                <td class="text-center align-middle">{{ $pedido->pedido_email }}</td>
                <td class="text-center align-middle">{{ $pedido->created_at->format('d-M-Y') }}</td>
                
                @switch($pedido->error)
                
                @case($pedido->error == 'completed')
                @if ($pedido->entregado == 1)
                <td class="text-center align-middle">Completado</td>          
                @break
                @endif
                
                @case($pedido->error == 'completed')
                @if ($pedido->entregado == 0)
                <td class="text-center align-middle">En proceso</td>          
                @break
                @endif
                
                @case(strpos($pedido->error, 'Reembolso'))
                @if ($pedido->entregado == 0)
                <td class="text-center align-middle">Cancelado</td>          
                @break
                @endif
                
                @case(strpos($pedido->error, 'Cancelado'))
                <td class="text-center align-middle">Cancelado</td>          
                @break
                
                @case($pedido->error == 'cupon pago por adelantado usado')
                @if ($pedido->entregado == 1)
                <td class="text-center align-middle">Completado</td>     
                @break
                @endif     
                
                @case($pedido->error == 'cupon pago por adelantado usado')
                @if ($pedido->entregado == 0)
                <td class="text-center align-middle">En proceso</td>     
                @break
                @endif     
                
                @endswitch
                
                <td class="text-center align-middle">${{ $pedido->pedido_total }}</td>
                
                @if ($pedido->error == 'completed' && $pedido->entregado == 0 && $pedido->pedido_total > 0)
                @can ('refund', Openpay::class)
                <td class="text-center align-middle">
                  <a href="{!! route('pedido.refundForm', ['user_id' => $pedido->user_id, 'transaction_id' => $pedido->transaction_id, 'pedido' => $pedido->id]) !!}" class="btn-sec">Reembolsar</a>
                </td>
                @endcan
                @endif
                <td class="text-center align-middle"> <a href="{!! route('pedidos.show', $pedido->id) !!}" class="btn-edit">Detalles</a> </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>
      
      <div class="float-right">
        {{ $pedidos->links() }}
      </div>
      
    </div>
  </section>
  
  @endsection
  