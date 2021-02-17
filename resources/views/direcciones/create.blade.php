@extends('layouts.app')

@section('scripts')

<script src="{{ asset('js/scriptMask.js') }}"></script>

@endsection

@section('content')
<section id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        
        <div class="section-header">
          @if ($direccion->exists)
          <h4>Editar dirección de envio</h4>
          @else
          <h4>Añadir una dirección de envio</h4>
          @endif
        </div>
        
        <section id="contact">
          <div class="form">
            @if ($direccion->exists)
            <form class="contactForm" action="{{ route('direccion.update', $direccion) }}" method="POST">
              {{ csrf_field() }}
              @method('patch')                
            @else
            <form class="contactForm" action="{{ route('direccion.store') }}" method="POST">
              {{ csrf_field() }}
            @endif
              
              <div class="row justify-content-center">                
                <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Calle</label>
                          <input id="cale" class="form-control{{ $errors->has('direccion_calle') ? ' is-invalid' : '' }}" type="text" name="direccion_calle" value="{{ old('direccion_calle', $direccion->calle) }}">
                          @if ($errors->has('direccion_calle'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('direccion_calle') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Número</label>
                          <input id="numero_direccion" class="form-control{{ $errors->has('direccion_numero') ? ' is-invalid' : '' }}" type="text" name="direccion_numero" value="{{ old('direccion_numero', $direccion->numero) }}">
                          @if ($errors->has('direccion_numero'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('direccion_numero') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Código postal</label>
                          <input id="cp" class="form-control{{ $errors->has('direccion_codigo_postal') ? ' is-invalid' : '' }}" type="text" name="direccion_codigo_postal" value="{{ old('direccion_codigo_postal', $direccion->codigo_postal) }}">
                          @if ($errors->has('direccion_codigo_postal'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('direccion_codigo_postal') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Colonia</label>
                          <input id="colonia" class="form-control{{ $errors->has('direccion_colonia') ? ' is-invalid' : '' }}" type="text" name="direccion_colonia" value="{{ old('direccion_colonia', $direccion->colonia) }}">
                          @if ($errors->has('direccion_colonia'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('direccion_colonia') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Ciudad</label>
                          <input id="ciudad" class="form-control{{ $errors->has('direccion_ciudad') ? ' is-invalid' : '' }}" type="text" name="direccion_ciudad" value="{{ old('direccion_ciudad', $direccion->localidad) }}">
                          @if ($errors->has('direccion_ciudad'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('direccion_ciudad') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Estado</label>
                          <input id="estado" class="form-control{{ $errors->has('direccion_estado') ? ' is-invalid' : '' }}" type="text" name="direccion_estado" value="{{ old('direccion_estado', $direccion->estado) }}">
                          @if ($errors->has('direccion_estado'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('direccion_estado') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">País</label>
                          <input id="pais" class="form-control{{ $errors->has('direccion_pais') ? ' is-invalid' : '' }}" type="text" name="direccion_pais" value="{{ old('direccion_pais', $direccion->pais) }}">
                          @if ($errors->has('direccion_pais'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('direccion_pais') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 mx-auto">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Referencias del lugar</label>
                          <textarea class="form-control" type="text" name="direccion_referencias">{{ old('direccion_referencias', $direccion->referencias) }}</textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="justify-content-center text-center">
                    <a href="{!! route('direccion.index') !!}" class="btn-sec" role="button">Regresar al perfil</a>
                    @if ($direccion->exists)
                    <button type="submit" class="btn-back mt-4">Editar</button>
                    @else
                    <button type="submit" class="btn-back mt-4">Guardar</button>
                    @endif
                  </div>
                  
                </div>
              </div>
            </form>
          </div>
        </section>
        
      </div>
    </div>
  </div>
</section>
@endsection