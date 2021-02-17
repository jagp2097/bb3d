@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 .col-md-offset-1">
        <div class="card">
          <div class="card-header">Usuarios</div>

            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <th scope="col"></th>
                  <th scope="col">Fecha venta</th>
                  <th scope="col">País</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Ciudad</th>
                  <th scope="col">Dirección</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Total</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                  @php
                  $count = 1;
                  @endphp
                  @foreach($ventas as $venta)
                    <tr>
                      <td scope='row'>{{ $count++ }}</td>
                      <td>{{ $venta->pais }}</td>
                      <td>{{ $venta->estado }}</td>
                      <td>{{ $venta->ciudad }}</td>
                      <td>{{ $venta->direccion }}</td>
                      <td>{{ $venta->users }}</td>
                      <td>{{ $venta->archivos }}</td>
                      <td> <a class="btn btn-warning btn-sm" role="button" href="{{ route('venta.show', $venta->id) }}">Ver detalle</a> </td>
                      {{-- <td> <a class="btn btn-info btn-sm" role="button" href="{{ route('venta.edit', $venta->id) }}">Editar</a> </td> --}}
                      {{-- <td>
                        <form class="" action="{{ route('venta.destroy', $venta->id) }}" method="post">
                          {{ csrf_field() }}
                          @method('DELETE')
                          <button class="btn btn-danger btn-sm" type="submit" name="button">Eliminar</button>
                        </form>
                      </td> --}}
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="card-footer text-right">
              <a href="{{ route('venta.create') }}" class="btn btn-success btn-sm">Crear albúm</a>
              <a href="{{ route('perfil.show') }}" class="btn btn-dark btn-sm">Perfil</a>
            </div>

          </div>
        </div>
    </div>
  </div>
@endsection
