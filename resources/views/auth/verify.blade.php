@extends('layouts.app')

@section('content')

<section id="clients">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="section-header">
                    <h4 class="title-sm">Verifica tu dirección de correo electrónico</h4>
                </div>

                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Un nuevo link de verificación ha sido enviado a tú dirección de correo electrónico.') }}
                    </div>
                @endif

                {{ __('Antes de seguir, por favor busque en su correo electrónico el link de verificación.') }}
                {{ __('Si no ha recibido ningún correo electrónico para la verificación de su cuenta, ') }} <a href="{{ route('verification.resend') }}">{{ __(' por favor de click aqui para reenviarselo de nuevo') }}</a>.
           

            </div>
        </div>
    </div>
</section>

@endsection
