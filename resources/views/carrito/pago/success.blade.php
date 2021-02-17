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
        <h4 class="ml-5">Pago Aceptado</h4>
    </div>
    
    <div class="row justify-content-center mt-4 mb-4">
        <div class="col-lg-8 col-md-8 col-sm-8 text-center" style="font-size:130%;">
            <i class="ion-checkmark payment-step-icon"></i>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <p class="payment-step-paragraph">Se ha realizado con éxito el cargo a tu tarjeta. Para seguir con el proceso y subir tu archivo .vol presiona el botón <strong>Continuar</strong>.</p> 
            <p class="payment-step-paragraph"><small><strong>Advertencia: </strong> Por favor, a partir de este momento no trates de regresar a la página anterior debido a que se podría realizar de nuevo el cargo a tu tarjeta.</small></p> 
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-10 text-center mt-4">
            <form id="completar-form" action="{{ route('pago.archivo') }}" method="GET">
            @csrf
                <button id="btn-completar" type="button" class="next btn-edit">Continuar</button>
            </form>
        </div>
    </div>
    
</section>
@endsection