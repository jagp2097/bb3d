@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/preview-image.js') }}"></script>
@endsection
@section('content')

@if($errors->any())
<div class="container alert alert-danger" role="alert">
  @foreach ($errors->all() as $error)
  <ul>
    <li>{{ $error }}</li>
  </ul>
  @endforeach
</div>    
@endif

{{-- #page>div.logo+ul#navigation>li*5>a{Item $} --}}
<section id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        
        <div class="section-header">
          <h4>Actualizar información de la cuenta</h4>
        </div>
        
        <section id="contact">
          <div class="form">
            <form class="contactForm" action="{!! route('perfil.update', ['perfil_id' => $perfil->id, 'user_id' => Auth::id()]) !!}" method="post" enctype="multipart/form-data">
              @method('PUT')
              {{ csrf_field() }}
              
              <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                  <div class="justify-content-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="text-center">
                        <div id="img-cont" class="col-lg-12 col-md-12 col-sm-12">
                          <img id="output_image" class="img-profile" src="{{ asset('images/perfil_fotos') }}/{{ $perfil->foto }}"/><br>
                        </div>
                        <label for="" class="control-label">Foto de perfil</label><br>
                        <input class="form-control{{ $errors->has('perfil_foto') ? ' is-invalid' : '' }} form-control-file" type="file" name="perfil_foto" onchange="preview_image(event)" value="{{ $perfil->perfil_foto }}">
                        @if ($errors->has('perfil_foto'))
                        <span class="invalid-feedback" role="alert">
                          <strong class="text-danger">{{ $errors->first('perfil_foto') }}</strong>
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="col-lg-8 col-md-8 col-sm-8">
                  <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class="justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Nombre</label>
                          <input  class="form-control{{ $errors->has('perfil_nombre') ? ' is-invalid' : '' }}" type="text" name="perfil_nombre" value="{{ old('perfil_nombre', $perfil->nombre) }}">
                          @if ($errors->has('perfil_nombre'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('perfil_nombre') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Apellidos</label>
                          <input class="form-control{{ $errors->has('perfil_apellidos') ? ' is-invalid' : '' }}" type="text" name="perfil_apellidos" value="{{ old('perfil_apellidos', $perfil->apellidos) }}">
                          @if ($errors->has('perfil_apellidos'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('perfil_apellidos') }}</strong>
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
                          <label for="">Correo electrónico</label>
                          <input class="form-control{{ $errors->has('perfil_correo') ? ' is-invalid' : '' }}" type="text" name="perfil_correo" value="{{ old('perfil_correo', $user->email) }}">
                          @if ($errors->has('perfil_correo'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('perfil_correo') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Fecha de nacimiento</label>
                          <input class="form-control{{ $errors->has('perfil_nacimiento') ? ' is-invalid' : '' }}" type="text" name="perfil_nacimiento" value="{{ old('perfil_nacimiento', $perfil->fecha_nacimiento) }}">
                          @if ($errors->has('perfil_nacimiento'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('perfil_nacimiento') }}</strong>
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
                          <label for="">País de origen</label>
                          <input class="form-control{{ $errors->has('perfil_pais_origen') ? ' is-invalid' : '' }}" type="text" name="perfil_pais_origen" value="{{ old('perfil_pais_origen', $perfil->pais_origen) }}">
                          @if ($errors->has('perfil_pais_origen'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('perfil_pais_origen') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                      <div class=" justify-content-center">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <label for="">Teléfono</label>
                          <input class="form-control{{ $errors->has('perfil_telefono') ? ' is-invalid' : '' }}" type="text" name="perfil_telefono" value="{{ old('perfil_telefono', $perfil->telefono) }}">
                          @if ($errors->has('perfil_telefono'))
                          <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('perfil_telefono') }}</strong>
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="justify-content-center text-center">
                    <a href="{!! route('perfil.show') !!}" class="btn-sec" role="button">Regresar al perfil</a>
                    <button type="submit" class="btn-back mt-3">Actualizar</button>
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
