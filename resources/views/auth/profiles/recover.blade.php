@extends('layouts/app')
@section('content') 

<section id="clients" class="payment-step my-5">

    <div class="section-header">
        <h4 class="ml-5">Recuperar cuenta</h4>
    </div>

    <div class="row justify-content-center mt-2 mb-4">

        <div class="col-md-12">

            <p class="payment-step-paragraph">Tu cuenta esta suspendida en este momento debido a que el día <strong>{{ Auth::user()->updated_at->format('d-M-Y') }}</strong> decidiste eliminar tu cuenta.
                Por seguridad nosotros mantenemos los datos de nuestros clientes por un año despúes de que estos han decidido eliminar su cuenta.
            </p>

            <p class="payment-step-paragraph">Para más información vea los <strong><a style="color: #1d99bf;" href="{{ route('legal.terminos') }}">Terminos y condiciones</a></strong> en el aparatado <strong>Cancelaciones</strong>.</p>
             
            <p class="payment-step-paragraph">Si deseas recuperar tu cuenta y recuperar toda tu informacion relacionada a ella, da clic en <strong>"Recuperar cuenta"</strong>.
            </p>            

        </div>

    </div>

    <div class="row mt-2 mb-3">

        <div class="col-md-12 text-center">

            <form action="{{ route('perfil.recover-account') }}" method="POST">
                @csrf
                <button type="submit" class="btn-sec">Recuperar cuenta</button>
            </form>

        </div>
        
    </div>

</section>

    
@endsection