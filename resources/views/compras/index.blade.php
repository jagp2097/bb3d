@extends('layouts.app')
@section('content')
<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <div class="section-header">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <h4>Mis Compras</h4>
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
            <th scope="col">Pedido a nombre</th>
            <th scope="col">Fecha pedido</th>
            <th scope="col">Estado de la Transacción</th>
            <th scope="col">Enviado</th>
            <th scope="col">Total</th>
            <th></th>
          </thead>
          <tbody>
            @foreach ($compras as $compra)
            <tr>
              <td class="text-center">{{ $compra->pedido_nombre }}</td>
              <td class="text-center">{{ $compra->created_at->format('d-M-Y') }}</td>
              <td class="text-center">{{ $compra->error }}</td>
              <td class="text-center">{{ $compra->entregado ? 'Si' : 'No' }}</td>
              <td class="text-center">${{ $compra->pedido_total }}</td>
              <td class="text-center"> <a class="btn-edit" href="{{ route('compra.show', $compra->id) }}">Detalles</a> </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </section>

    <div class="row">
      <div class="col-md-6">

        <small style="color: #ef597d;">Si requiere una modificación al pedido que ha hecho, puede contactarnos enviando un correo eléctronico a <strong>contacto@bb3d.mx</strong> </small>

      </div>
      <div class="col-md-6">
        <div class="float-right">
          {{ $compras->links() }}
        </div>
      </div>
    </div>
    


  </div>
</section>

@endsection
