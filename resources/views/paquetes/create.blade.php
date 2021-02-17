@extends('layouts.app')
@section('content')

<section id="services">
  <div class="container">
    <div class="section-header">
        @if($paquete->exists)
          <h4>Editar paquete</h4>
        @else
          <h4>Crear paquete</h4>
        @endif
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8">

        <section id="contact">
          <div class="form">
            @if($paquete->exists)
            <form class="" action="{{ route('paquete.update', $paquete->id) }}" method="post" enctype="multipart/form-data">
              @method('PATCH')
              {{ csrf_field() }}
            @else
            <form class="" action="{{ route('paquete.store') }}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
            @endif

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="paquete_nombre" class="col-md-6 control-label">Nombre del paquete *</label>
                <input name="nombre" id="paquete_nombre" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" type="text" @if($paquete->exists) value="{{ $paquete->nombre }}" @endif>
              </div>

              @if ($errors->has('nombre'))
              <span class="help-block ">
                <strong class="text-danger">{{ $errors->first('nombre') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="descripcion_paquete" class="col-md-6 control-label">Descripción del paquete *</label>
                <input name="descripcion" id="descripcion_paquete" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" type="text" @if($paquete->exists) value="{{ $paquete->descripcion }}" @endif>
              </div>

              @if ($errors->has('descripcion'))
              <span class="help-block ">
                <strong class="text-danger">{{ $errors->first('descripcion') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="precio_paquete" class="col-md-6 control-label">Precio del paquete *</label>
                <input name="precio" id="precio_paquete" class="form-control{{ $errors->has('precio') ? ' is-invalid' : '' }}" type="number" min="1" step=".10" @if($paquete->exists) value="{{ $paquete->precio }}" @endif>
              </div>

              @if ($errors->has('precio'))
              <span class="help-block ">
                <strong class="text-danger">{{ $errors->first('precio') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="foto_paquete" class="col-md-6 control-label">Foto del paquete *</label>
                <input name="foto" id="foto_paquete" class="form-control{{ $errors->has('foto') ? ' is-invalid' : '' }}" type="file" @if($paquete->exists) value="{{ $paquete->precio }}" @endif>
              </div>

              @if ($errors->has('foto'))
              <span class="help-block ">
                <strong class="text-danger">{{ $errors->first('foto') }}</strong>
              </span>
              @endif
            </div>
            
            <input type="hidden" name="entregable" value="1">

            {{-- <div class="form-row">
              <div class="form-group">
                <label for="entregable" class="col-md-12">¿El paquete se debe enviar? *</label>
                <div class="col-md-12">
                  <select class="form-control" name="entregable">
                      <option value="1" selected>Si</option>
                      <option value="0">No</option>
                  </select>
                  @if ($errors->has('entregable'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('entregable') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div> --}}

            <div class="form-row">
              <div class="form-group">
                <label for="publicado" class="col-md-12">Publicar en catálogo *</label>
                <div class="col-md-12">
                    <select class="form-control" name="publicado">
                        <option value="0">No</option>
                        <option value="1" selected>Si</option>
                    </select>
                  @if ($errors->has('publicado'))
                    <span class="help-block ">
                      <strong class="text-danger">{{ $errors->first('publicado') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="text-right">
                <a href="{{ route('paquete.index') }}" class="btn-sec">Regresar</a>
                <button type="submit" class="btn-back">Guardar</button>
            </div>

          </div>
        </section>

      </div>
    </div>
  </div>
</section>
           

@endsection
