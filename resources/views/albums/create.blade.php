@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-2">
      <div class="card">
        <div class="card-header"> <h4>Agregar usuario</h4> </div>

        <div class="card-body">

          @if ($album->exists)
            <form class="" action="{{ route('album.update', $album->id) }}" method="post">
              @method('PATCH')
              {{ csrf_field() }}
          @else
            <form class="" action="{{ route('album.store') }}" method="post">
              {{ csrf_field() }}
          @endif
            <h5>Crear albúm</h5>
            <div class="form-group">
              <label for="album_nombre" class="col-md-3 control-label">Nombre del albúm *</label>
              <div class="col-md-9">
                <input type="text" name="nombre_album" id="album_nombre" class="form-control" @if($album->exists) value="{{ $album->nombre_album }}" @endif />
                @if ($errors->has('nombre_album'))
                  <span class="help-block ">
                    <strong class="text-danger">{{ $errors->first('nombre_album') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="descripcion_album" class="col-md-3 control-label">Descripción del albúm *</label>
              <div class="col-md-9">
                <input type="text" name="descripcion" id="descripcion_album" class="form-control" @if($album->exists) value="{{ $album->descripcion }}" @endif/>
                @if ($errors->has('descripcion'))
                  <span class="help-block ">
                    <strong class="text-danger">{{ $errors->first('descripcion') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <input type="hidden" name="user_id" @if($album->exists) value="{{ $album->user_id }}" @endif>

            <div class="card-footer text-right">
              <a href="{{ route('album.index') }}" class="btn btn-secondary btn-sm">Regresar</a>
              <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection
