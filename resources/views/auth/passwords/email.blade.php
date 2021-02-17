@extends('layouts.app')
@section('content')

<section id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        
        <div class="section-header">
          <h4>Restaurar contraseña</h4>
        </div>
        
        @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
        @endif
        
        <section id="contact">
          <div class="form">
            <form class="contactForm" method="POST" action="{{ route('password.email') }}">
              @csrf
              
              <div class="form-row justify-content-center">
                <div class="form-group col-md-12">
                  
                  <label for="email" class="col-md-4">{{ __('Correo electrónico') }}</label>
                  <div class="col-md-10">
                      <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                      @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                        <strong class="text-danger">{{ $errors->first('email') }}</strong>
                      </span>
                      @endif
                  </div>
                  
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn-sec">
                    {{ __('Enviar enlace para restaurar contraseña') }}
                  </button>
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
