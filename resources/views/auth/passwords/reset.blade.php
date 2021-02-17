@extends('layouts.app')
@section('content')

<section id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <div class="section-header">
                    <h4>Restaurar contraseña</h4>
                </div>
                
                <section id="contact">
                    <div class="form">
                        <form method="POST" action="{{ route('password.update') }}" class="contacForm">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-12">
                                    
                                    <label for="email" class="col-md-4">{{ __('Correo electrónico') }}</label>
                                    <div class="col-md-10">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" autofocus>
                                        
                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div> 
                            
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-12">
                                    
                                    <label for="password" class="col-md-4">{{ __('Contraseña') }}</label>
                                    
                                    <div class="col-md-10">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                                        
                                        @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    
                                </div>
                            </div> 
                            
                            <div class="form-row justify-content-center">
                                <div class="form-group col-md-12">
                                    
                                    <label for="password-confirm" class="col-md-4">{{ __('Confirmar contraseña') }}</label>
                                    
                                    <div class="col-md-10">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-sec">
                                    {{ __('Restaurar contraseña') }}
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </section>
                
            </div>
        </div>
    </div>
</section>

@endsection
