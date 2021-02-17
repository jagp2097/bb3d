@extends('layouts.app')

@section('scripts')

<script>
    $(document).ready(function() {
        
        $('#btn-completar').on('click', function(event) {
            event.preventDefault();
            
            $('#btn-completar').prop('disabled', true);
            $('#completar-form').submit();
            
        });
    });
    
</script>

@endsection



@section('content')

<section id="clients" class="payment-step mx-auto my-5">

    <div class="section-header">
        <h4 class="ml-5">Pago rechazado</h4>
    </div>
    
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-lg-8 col-md-8 col-sm-8 text-center" style="font-size:130%;">
            <i class="ion-close payment-step-icon"></i>
        </div>
    </div>
    
    <div class="row justify-content-center text-center">
        <div class="col-md-10">
            <p class="payment-step-paragraph">No se ha podido realizar el cargo a tu tarjeta porque ha sido rechazada.</p> 
            <p class="payment-step-paragraph">Verifica los datos que aparecen en tu tarjeta e intenta realizar el proceso de pago más tarde.</p> 
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-10 text-center mt-4">
            <a class="btn-edit" href="{{ route('perfil.show', ['id'=>1]) }}">Regresar a tu perfil</a>
        </div>
    </div>
    
</section>


@endsection