@extends('layouts.app')
@section('content')

<section id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 box">
        
        <div class="section-header">
          @if(!$ginecologo->exists)
            <h4>Añadir ginecólogo</h4>
          @else
            <h4>Editar ginecólogo</h4>
          @endif
        </div>

        <section id="contact">
          <div class="form">
            @if ($ginecologo->exists)
            <form class="contactForn" action="{{ route('ginecologo.update', $ginecologo) }}" method="POST">
              {{ method_field('PATCH')}}
              {{ csrf_field() }}
              <input type="hidden" name="id" value="{{ $ginecologo->id }}" />
            @else
            <form class="contactForn" action="{{ route('ginecologo.store') }}" method="POST">
              {{ csrf_field() }}
            @endif
              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                  <label for="ginecologo_nombre">Nombre(s)*</label>
                  <input type="text" name="ginecologo[nombre]" id="ginecologo_nombre" class="form-control{{ $errors->has('ginecologo.nombre') ? ' is-invalid' : '' }}" value="{{ old('ginecologo.nombre', $ginecologo->nombre) }}" />
                  @if ($errors->has('ginecologo.nombre'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="text-danger">{{ $errors->first('ginecologo.nombre') }}</strong>
                    </span>
                  @endif
                </div> 
              </div>

              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                  <label for="ginecologo_ap_pa">Apellido Paterno*</label>
                  <input type="text" name="ginecologo[ap_pa]" id="ginecologo_ap_pa" class="form-control{{ $errors->has('ginecologo.ap_pa') ? ' is-invalid' : '' }}" value="{{ old('ginecologo.ap_pa', $ginecologo->ap_pa) }}" />
                  @if ($errors->has('ginecologo.ap_pa'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="text-danger">{{ $errors->first('ginecologo.ap_pa') }}</strong>
                    </span>
                  @endif
                </div> 
              </div>

              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                  <label for="ginecologo_ap_ma">Apellido Materno*</label>
                  <input type="text" name="ginecologo[ap_ma]" id="ginecologo_ap_ma" class="form-control{{ $errors->has('ginecologo.ap_ma') ? ' is-invalid' : '' }}" value="{{ old('ginecologo.ap_ma', $ginecologo->ap_ma) }}" />
                  @if ($errors->has('ginecologo.ap_ma'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="text-danger">{{ $errors->first('ginecologo.ap_ma') }}</strong>
                    </span>
                  @endif
                </div> 
              </div>

              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                  <label for="ginecologo_estado">Estado *</label>
                  <input type="text" name="ginecologo[estado]" id="ginecologo_estado" class="form-control{{ $errors->has('ginecologo.estado') ? ' is-invalid' : '' }}" value="{{ old('ginecologo.estado', $ginecologo->estado) }}" />
                  @if ($errors->has('ginecologo.estado'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="text-danger">{{ $errors->first('ginecologo.estado') }}</strong>
                    </span>
                  @endif
                </div> 
              </div>

              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                <label for="ginecologo_municipio">Municipio*</label>
                  <input type="text" name="ginecologo[municipio]" id="ginecologo_municipio" class="form-control{{ $errors->has('ginecologo.municipio') ? ' is-invalid' : '' }}" value="{{ old('ginecologo.municipio', $ginecologo->municipio) }}" />
                  @if ($errors->has('ginecologo.municipio'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="text-danger">{{ $errors->first('ginecologo.municipio') }}</strong>
                    </span>
                  @endif
                </div> 
              </div>

              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                <label for="ginecologo_direccion">Dirección*</label>
                <input type="text" name="ginecologo[direccion]" id="ginecologo_direccion" class="form-control{{ $errors->has('ginecologo.direccion') ? ' is-invalid' : '' }}" value="{{ old('ginecologo.direccion', $ginecologo->direccion) }}" />
                  @if ($errors->has('ginecologo.direccion'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="text-danger">{{ $errors->first('ginecologo.direccion') }}</strong>
                    </span>
                  @endif
                </div> 
              </div>

              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                <label for="ginecologo_telefono">Teléfono*</label>
                <input type="text" name="ginecologo[telefono]" id="ginecologo_telefono" class="form-control{{ $errors->has('ginecologo.telefono') ? ' is-invalid' : '' }}" value="{{ old('ginecologo.telefono', $ginecologo->telefono ) }}" />
                  @if ($errors->has('ginecologo.telefono'))
                    <span class="invalid-feedback" role="alert">
                      <strong class="text-danger">{{ $errors->first('ginecologo.telefono') }}</strong>
                    </span>
                  @endif
                </div> 
              </div>

              <div class="justify-content-center text-center">
                <a href="{{ route('ginecologo.index') }}" role="button" class="btn-back">Regresar</a>
                @if($ginecologo->exists)
                  <button type="submit" class="btn-back">Editar</button>
                @else
                  <button type="submit" class="btn-back">Guardar</button>
                @endif
              </div>
            </form>
            
          </div>
        </section>

      </div>
    </div>
  </div>
</section>

@endsection
