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
                  <th scope="col">Nombre del albúm</th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Archivos</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </thead>
                <tbody>
                  @php
                  $count = 1;
                  @endphp
                  @foreach($albums as $album)
                    <tr>
                      <td scope='row'>{{ $count++ }}</td>
                      <td>{{ $album->nombre_album }}</td>
                      <td>{{ $album->descripcion }}</td>
                      <td>{{ $album->archivos->count() }}</td>
                      <td>
                        @can ('show', $album)
                          <a class="btn btn-warning btn-sm" role="button" href="{{ route('album.show', $album->id) }}">Ver</a>
                        @endcan
                      </td>
                      <td>
                        @can ('update', $album)
                          <a class="btn btn-info btn-sm" role="button" href="{{ route('album.edit', $album->id) }}">Editar</a>
                        @endcan
                      </td>
                      <td>
                        @can ('update', $album)
                          <form class="" action="{{ route('album.destroy', $album->id) }}" method="post">
                            {{ csrf_field() }}
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit" name="button">Eliminar</button>
                          </form>
                        @endcan
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            <div class="card-footer text-right">
              @can ('create', bagrap\Album::class)
                <a href="{{ route('album.create') }}" class="btn btn-success btn-sm">Crear albúm</a>
              @endcan
              <a href="{{ route('perfil.show') }}" class="btn btn-dark btn-sm">Perfil</a>
            </div>

          </div>
        </div>
    </div>
  </div>
@endsection
