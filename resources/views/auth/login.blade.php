@extends('layouts.app')
@section('content')

@if (session('isActive'))
<div class="container alert alert-danger" role="alert">
  {{ session('isActive') }}
</div>
@elseif($errors->any())
<div class="container alert alert-danger" role="alert">
  @foreach ($errors->all() as $error)
  <ul>
    <li>{{ $error }}</li>
  </ul>
  @endforeach
</div>    
@endif

<section id="services">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 box">
        
        <div class="section-header text-center">
          <h2>Log in</h2>
        </div>

        <section id="contact">
          <div class="form">
            <form method="POST" class="contactForm" action="{{ route('login') }}">
              @csrf
              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                  <label class="title" for="email">{{ __('Correo electrónico') }}</label>
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}">
                </div>
              </div>

              <div class="form-row justify-content-center">
                <div class="form-group col-md-8">
                  <label for="password">{{ __('Contraseña') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                </div>
              </div>

              <div class="form-row justify-content-center m-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label" for="remember">
                    {{ __('Recordar') }}
                  </label>
                </div>
              </div>

              <div>
                <div class="form-row justify-content-center mb-2">
                  <button type="submit" class="text-center btn-sec">
                    {{ __('Acceder') }}
                  </button>
                </div>

                <div class="form-row justify-content-center">
                  @if(Route::has('register'))
                    <a class="btn btn-link" href="{{ route('register') }}">
                      {{ __('¿No tienes una cuenta? Registrate') }}
                    </a>
                  @endif
                </div>

                <div class="form-row justify-content-center">
                  @if (Route::has('password.request'))
                  <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('¿Olvidaste tu contraseña?') }}
                  </a>
                  @endif
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
