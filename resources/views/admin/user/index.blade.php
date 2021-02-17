@extends('layouts.app')
@section('content')

    {{-- {{ dd($clientes) }} --}}

  <div class="container">
    <div class="row">
      <h2>Administrador</h2>
      <a class="btn btn-sm btn-secondary" role="button" href="{!! route('pedidos.index') !!}">Pedidos</a>

    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Usuarios</div>

            <div class="table-responsive">
              <table class="table table-hover table-sm">
                <thead>
                  <th scope="col"></th>
                  <th scope="col">Nombre del usuario</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Status</th>
                  <th scope="col">País</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Creado</th>
                  <th scope="col">Actualizado</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                  @foreach($users as $user)
                    <tr>
                      <td scope='row'>{{ $loop->iteration }}</td>
                      <td>{{ $user->perfil->nombre }}</td>
                      <td>{{ $user->perfil->apellidos }}</td>
                      <td>{{ $user->role['name'] }}</td>
                      <td>{{ $user->is_active ? 'Activo' : 'No activo' }}</td>
                      <td>{{ $user->perfil->pais_origen }}</td>
                      <td>{{ $user->perfil->telefono }}</td>
                      <td>{{ $user->perfil->created_at->diffForHumans() }}</td>
                      <td>{{ $user->perfil->updated_at->diffForHumans() }}</td>
                      <td> <a class="btn btn-warning btn-sm" role="button" href="{{ route('users.show', $user->id) }}">Ver</a> </td>
                      <td> <a class="btn btn-info btn-sm" role="button" href="{{ route('users.edit', $user->id) }}">Editar</a> </td>
                      <td>
                          <form class="" action="{{ route('users.destroy', $user->id) }}" method="post">
                              {{ csrf_field() }}
                              @method('DELETE')
                              <button class="btn btn-danger btn-sm" type="submit" name="button">Eliminar</button>
                          </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="card-footer text-right">
              <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">Crear usuario</a>
              <a href="{{ route('perfil.show') }}" class="btn btn-dark btn-sm">Perfil</a>
            </div>

          </div>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Openpay Clientes</div>

                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <th scope="col"></th>
                      <th scope="col">Id cliente OpenPay</th>
                      <th scope="col">Creación</th>
                      <th scope="col"></th>
                    </thead>
                    <tbody>
                      @foreach($clientes as $cliente)
                        <tr>
                          <td scope='row'>{{ $loop->iteration }}</td>
                          <td>{{ $cliente->id }}</td>
                          <td>{{ $cliente->creation_date }}</td>

                          {{-- <td> <a class="btn btn-warning btn-sm" role="button" href="{{ route('user.show', $cliente->id) }}">Ver</a> </td> --}}
                          {{-- <td> <a class="btn btn-info btn-sm" role="button" href="{{ route('user.edit', $cliente->id) }}">Editar</a> </td> --}}
                          <td>
                              <form class="" action="{!! route('openpay.deleteCustomer', $cliente->id) !!}" method="post">
                                  {{ csrf_field() }}
                                  @method('DELETE')
                                  <button class="btn btn-danger btn-sm" type="submit" name="button">Eliminar</button>
                              </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>

                <div class="card-footer text-right">
                  <a href="{{ route('users.create') }}" class="btn btn-success btn-sm">Crear usuario</a>
                  <a href="{{ route('perfil.show') }}" class="btn btn-dark btn-sm">Perfil</a>
                </div>

            </div>
        </div>
    </div>


  </div>
@endsection
