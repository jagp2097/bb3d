@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-md-10 col-md-offset-2">
        <div class="card">
          <div class="card-header"> <h4>Agregar archivo</h4> </div>

          <div class="card-body">

            @if ($archivo->exists)
              <form class="" action="{{ route('archivo.update', $archivo->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('PATCH')
            @else
              <form class="" action="{{ route('archivo.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
            @endif
              <h5>Agregar archivo</h5>
              <div class="form-group">
                <label for="archivo_nombre" class="col-md-3 control-label">Nombre del archivo *</label>
                <div class="col-md-9">
                  <input type="text" name="nombre_archivo" id="archivo_nombre" class="form-control" @if($archivo->exists) value="{{ $archivo->nombre_archivo }}" @endif />
                  @if ($errors->has('nombre_archivo'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('nombre_archivo') }}</strong>
                    </span>
                  @endif
                </div>
              </div>

              @if (!$archivo->exists)
                <div class="form-group">
                  <label for="archivo" class="col-md-3 control-label">Archivo *</label>
                  <div class="col-md-9">
                    <input type="file" name="archivo" id="archivo"/>
                    @if ($errors->has('archivo'))
                      <span class="help-block ">
                        <strong class="text-danger">{{ $errors->first('archivo') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
              @endif

              {{-- }}<input type="hidden" name="user_id" @if($archivo->exists) value="{{ $archivo->user_id }}" @endif>--}}

              <div class="card-footer text-right">
                <a href="{{ route('archivo.index') }}" class="btn btn-secondary btn-sm">Regresar</a>
                @if ($archivo->album_id != null)
                  <a href="{{ route('album.show', $archivo->album_id) }}" class="btn btn-secondary btn-sm">Regresar al álbum</a>
                @else
                  <button type="submit" class="btn btn-primary btn-sm">Subir</button>
                @endif
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
