@extends('layouts.app')
@section('scripts')
  <script src="{{ asset('js/scriptMask.js') }}"></script>
@endsection
@section('content')

<div id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        
        <div class="section-header text-center">
          <h2>Registrarse</h2>
        </div>
        
        <section id="contact">
          <div class="form">
            <form method="POST" action="{{ route('register') }}">
              @csrf
              
              <div class="row">

                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label for="nombre">Nombre(s)</label>
                      <input type="text" placeholder="Ingrese su(s) nombre(s)" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}"  />
                      @if ($errors->has('nombre'))
                      <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('nombre') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label>Apellido(s)</label>
                      <input type="text" placeholder="Ingrese su(s) apellido(s)" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ old('apellidos') }}">
                      @if ($errors->has('apellidos'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('apellidos') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">

                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label>Fecha de nacimiento</label>
                      <input id="fecha_nacimiento" placeholder="Ejemplo: 01/01/1998" type="text" class="form-control{{ $errors->has('fecha_nacimiento') ? ' is-invalid' : '' }}" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                      @if ($errors->has('fecha_nacimiento'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label>País de origen</label>
                      <input id="pais_origen" type="text" placeholder="Ingrese su país de origen" class="form-control{{ $errors->has('pais_origen') ? ' is-invalid' : '' }}" name="pais_origen" value="{{ old('pais_origen') }}">
                      @if ($errors->has('pais_origen'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('pais_origen') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">

                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label>Teléfono</label>
                      <input id="telefono" type="tel" placeholder="Ejemplo: (00) 0000 0000" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}">
                      @if ($errors->has('telefono'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('telefono') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label>Correo electrónico</label>
                      <input id="email" type="text" placeholder="Ejemplo: bebe@ejemplo.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                      @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="row">
                
                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label for="password">{{ __('Contraseña') }}</label>
                      <input id="password" type="password" placeholder="Mínimo 6 caracteres" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
                      @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                      @endif
                    </div>
                  </div>                  
                </div>

                <div class="col-md-6">
                  <div class="form-row justify-content-center">
                    <div class="form-group col-md-11">
                      <label for="password-confirm">{{ __('Confirmar contraseña') }}</label>
                      <input id="password-confirm" placeholder="Repita la contraseña" type="password" class="form-control" name="password_confirmation" >
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="form-row justify-content-center mt-2 mb-2">
                <button type="submit" class="text-center btn-sec">
                  {{ __('Registrarse') }}
                </button>
              </div>
              
            </form>
          </div>
        </section>
        
      </div>
    </div>
  </div>
</div>

@endsection
