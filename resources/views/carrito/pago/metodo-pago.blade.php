@extends('layouts.app')
@section('scripts')

<script src="{{ asset('js/scriptMask.js') }}"></script>

{{-- Con el siguiente código se cargan las librerías necesarios para la generación del id de dispositivo: --}}
{{-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script> --}}
<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
<script type="text/javascript" src="{!! asset('js/elementos-confirmar.js') !!}"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

{{-- Con el siguiente código se inicializa el valor para el device_session_id: --}}
<script type="text/javascript">
  $(document).ready(function() {
    
    OpenPay.setId('mj7glzez1snwbqq4lcfz');
    OpenPay.setApiKey('pk_ca4d30bf53d1422a973c5837b3bb57ae');
    OpenPay.setSandboxMode(true);
    
    //Se genera el id de dispositivo
    var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
    
    if (Boolean({{ $cards->isEmpty() }})) {
      $('#next-button').on('click', function(event) {
        event.preventDefault();
        $('#next-button').prop('disabled', true);
        OpenPay.token.extractFormAndCreate('payment-form', success_callbak, error_callbak);
        
      });
      
    } else {
      
      $('#next-button').on('click', function(event) {
        event.preventDefault();
        
        $('#next-button').prop('disabled', true);
        
        if ( $('#btnOcultar').text() == 'Tarjetas guardadas' ) {
          // Si es verdadero, es porque utilizará una tarjeta nueva
          $('#card').val(null);
          
          // Genera el token de la tarjeta
          OpenPay.token.extractFormAndCreate('payment-form', success_callbak, error_callbak);
          
        } else if ($('#btnOcultar').text() == 'Nueva tarjeta') {
          
          $('#next-button').prop('disabled', true);
          
          // Si es verdadero, es porque utilizará una tarjeta guardada
          $('#holder_name').val(null);
          $('#card_number').val(null);
          $('#expiration_month').val(null);
          $('#expiration_year').val(null);
          $('#cvv').val(null);
          
          $('#payment-form').submit();
          
        }
        
      });
      
    }
    
    var success_callbak = function(response) {
      var token_id = response.data.id;
      $('#token_id').val(token_id);
      $('#payment-form').submit();
    };
    
    var error_callbak = function(response) {
      var desc = response.data.description != undefined ? response.data.description : response.message;
      // alert("ERROR [" + response.status + "] " + desc);
      $('html, body').animate({scrollTop:0}, 'slow');
      $('#cardErrors').append('<div id="errors" class="container alert alert-danger" role="alert">ERROR [' + response.status + '] ' + desc +'</div>');
      $('#errors').delay(3000).fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
      
      $("#next-button").prop("disabled", false);
      
    };
    
  });
</script>
@endsection

@section('content')

@if (session('errors_checkout'))
<div class='alert alert-danger' role='alert'>
  {{ session('errors_checkout') }}
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
@endif

<div id="cardErrors"></div>

@if($errors->any())
<div class="container alert alert-danger" role="alert">
  @foreach ($errors->all() as $error)
  <ul>
    <li>{{ $error }}</li>
  </ul>
  @endforeach
</div>    
@endif

<section id="clients" class="payment-step mx-auto my-5">
  
  <div class="section-header">
    <h4 class="ml-5">Forma de pago</h4>
  </div>
  
  <div class="row justify-content-center mt-5 mb-4">
    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
      <i class="far fa-credit-card payment-step-icon"></i>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
      <p class="payment-step-paragraph">Elige una tarjeta para realizar tu pago, puedes elegir una que haz guardado o utilizar una tarjeta diferente para pagar.</p>
    </div>
  </div>
  
  <div class="row justify-content-center">
    <div class="col-md-10">
      
      <div class="form">
        <form id="payment-form" action="{{ route('pago.tarjeta-post') }}" method="POST" enctype="multipart/form-data">
          @csrf
          {{-- Id tarjeta --}}
          <input type="hidden" name="token_id" id="token_id">
          {{-- SI NO HAY TARJETAS GUARDADAS --}}
          @if ($cards->isEmpty())
          {{-- Openpay tarjetas de credito --}}
          
          <div class="row">
            
            <div class="col-lg-5 col-md-5 col-sm-5 pb-3 text-center">
              <h5 class="payment-step-tittle">Tarjetas de crédito</h5>
              <img class="openpay-credit-cards" src="{!! asset('images/openpay/cards1.png') !!}" alt="openpay credit cards">
            </div>
            
            <div class="col-lg-7 col-md-7 col-sm-7 text-center">
              <h5 class="payment-step-tittle">Tarjetas de débito</h5>
              <img class="openpay-debit-cards" src="{!! asset('images/openpay/cards2.png') !!}" alt="openpay debit cards">
            </div>
            
          </div>
          
          <div class="form-group">
            <div class="row justify-content-center">
              
              <div class="col-md-4">
                <label for="holder_name" class="col-md-10">Nombre del titular *</label>
                <div class="col-md-12">
                  <input type="text" placeholder="Igual que en la tarjeta" data-openpay-card="holder_name" name="holder_name" id="holder_name" class="form-control" value="{{ old('holder_name') }}"/>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="card_number" class="col-md-10">Número de tarjeta *</label>
                  <div class="col-md-12">
                    <input type="text" placeholder="16 digítos" name="card_number" id="card_number" data-openpay-card="card_number" class="form-control" value="{{ old('card_number') }}"/>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="form-group">
            <div class="row justify-content-center">
              
              <div class="col-md-4">
                <label for="expiration_month" class="col-md-10">Mes de expiración*</label>
                <div class="col-md-12">
                  <input id="expiration_month" type="text" placeholder="Ejemplo: 03" data-openpay-card="expiration_month" name="expiration_month" class="form-control" value="{{ old('expiration_month') }}"/>
                </div>
              </div>
              
              <div class="col-md-4">
                <label for="expiration_year" class="col-md-10">Año de expiración*</label>
                <div class="col-md-12">
                  <input id="expiration_year" type="text" placeholder="Ejemplo: 88" data-openpay-card="expiration_year" name="expiration_year" class="form-control" value="{{ old('expiration_year') }}"/>
                </div>
              </div>
              
              <div class="col-md-4">
                <label for="cvv2" class="col-md-10">Código de seguridad</label>
                <div class="col-md-12 text-center">
                  <input id="cvv" type="text" placeholder="CVV" name="cvv2" data-openpay-card="cvv2" class="form-control" value="{{ old('cvv2') }}"/>
                  <img class="text-center" src="{!! asset('images/openpay/cvv.png') !!}" alt="">
                </div>
              </div>
              
            </div>
          </div>
          
          <div class="row justify-content-center">
            <div class="col-md-4 mt-2 text-center">
              <small>Transacciones realizadas vía:</small><br/>
              <img src="{!! asset('images/openpay/openpay.png') !!}" alt="">
              
            </div>
            <div class="col-md-7 mt-2 text-center">
              <img src="{!! asset('images/openpay/security.png') !!}" alt="">
              <small>Pagos seguros con encriptación de 256 bits</small>
            </div>
          </div>
          
        </div>
      </div>
      {{-- FIN SI NO HAY TARJETAS GUARDADAS --}}
      {{-- SI HAY TARJETAS GUARDADAS --}}
      @else
      <div id="saved-cards">
        {{-- MUESTRA TODAS LAS TARJETAS GUARDADAS --}}
        <div class="row container justify-content-center form">
          
          <div class="col-md-8 text-center">
            <div class="form-group">
              <h3 class="payment-step-tittle">Utilice una de sus tarjetas guardadas</h3>
              <select id="card" name="card" style="font-family: FontAwesome, sans-serif;">
                @foreach ($cards as $card)
                <option value="{{ $card->id }}">
                  @switch($card->brand)
                  @case('visa')
                  &#xf1f0;
                  @break
                  
                  @case('mastercard')
                  &#xf1f1;
                  @break
                  
                  @case('american_express')
                  &#xf1f3;
                  @break
                  
                  @default
                  &#xf09d;
                  @endswitch
                  
                  {{ $card->serializableData['card_number'] }}</option>
                  @endforeach
                </select>
                @if ($errors->has('card'))
                <span class="help-block ">
                  <small class="text-danger">{{ $errors->first('card') }}</small>
                </span>
                @endif
              </div>
            </div>
          </div>
        </div>
        {{-- FIN MUESTRA TODAS LAS TARJETAS GUARDADAS --}}
        
        {{-- ELIGIO UTILIZAR OTRA TARJETA DIFERENTE A LAS GUARDADAS --}}
        <div id="other-card" class="container">
          <div class="form">
            <div class="row">
              
              <div class="col-lg-5 col-md-5 col-sm-5 pb-3 text-center">
                <h5 class="payment-step-tittle">Tarjetas de crédito</h5>
                <img class="openpay-credit-cards" src="{!! asset('images/openpay/cards1.png') !!}" alt="openpay credit cards">
              </div>
              
              <div class="col-lg-7 col-md-7 col-sm-7 text-center">
                <h5 class="payment-step-tittle">Tarjetas de débito</h5>
                <img class="openpay-debit-cards" src="{!! asset('images/openpay/cards2.png') !!}" alt="openpay debit cards">
              </div>
              
            </div>
            
            <div class="form-group">
              <div class="row justify-content-center">
                
                <div class="col-md-4">
                  <label for="holder_name" class="col-md-10">Nombre del titular *</label>
                  <div class="col-md-12">
                    <input type="text" placeholder="Igual que en la tarjeta" data-openpay-card="holder_name" name="holder_name" id="holder_name" class="form-control" value="{{ old('holder_name') }}"/>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="card_number" class="col-md-10">Número de tarjeta *</label>
                    <div class="col-md-12">
                      <input type="text" placeholder="16 digítos" name="card_number" id="card_number" data-openpay-card="card_number" class="form-control" value="{{ old('card_number') }}"/>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            
            <div class="form-group">
              <div class="row justify-content-center">
                
                <div class="col-md-4">
                  <label for="expiration_month" class="col-md-10">Mes de expiración*</label>
                  <div class="col-md-12">
                    <input id="expiration_month" type="text" placeholder="Ejemplo: 03" data-openpay-card="expiration_month" name="expiration_month" class="form-control" value="{{ old('expiration_month') }}"/>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <label for="expiration_year" class="col-md-10">Año de expiración*</label>
                  <div class="col-md-12">
                    <input id="expiration_year" type="text" placeholder="Ejemplo: 88" data-openpay-card="expiration_year" name="expiration_year" class="form-control" value="{{ old('expiration_year') }}"/>
                  </div>
                </div>
                
                <div class="col-md-4">
                  <label for="cvv2" class="col-md-10">Código de seguridad</label>
                  <div class="col-md-12 text-center">
                    <input id="cvv" type="text" placeholder="CVV" name="cvv2" data-openpay-card="cvv2" class="form-control" value="{{ old('cvv2') }}"/>
                    <img class="text-center" src="{!! asset('images/openpay/cvv.png') !!}" alt="">
                  </div>
                </div>
                
              </div>
            </div>
            
            <div class="row justify-content-center">
              <div class="col-md-4 mt-2 text-center">
                <small>Transacciones realizadas vía:</small><br/>
                <img src="{!! asset('images/openpay/openpay.png') !!}" alt="">
                
              </div>
              <div class="col-md-7 mt-2 text-center">
                <img src="{!! asset('images/openpay/security.png') !!}" alt="">
                <small>Pagos seguros con encriptación de 256 bits</small>
              </div>
            </div>
            
          </div>
        </div>
        {{-- FIN SE ELIGIO UNA TAJETA DIFERENTE A LAS TARJETAS GUARDADAS --}}
        @endif
        
        @if (!$cards->isEmpty())
        <div class="col-md-12 text-center mt-3 mb-5">
          <button id="btnOcultar" class="btn-back" type="button" name="button"> Nueva tarjeta </button>
        </div>
        @endif
        
        <div class="col-md-12 text-right mt-4 mr-5">
          <a  href="{!! route('pago.total') !!}" class="previous btn-back">Anterior</a>
          <button id="next-button" type="button" class="next btn-del">Realizar pago</button>
        </div>
        
      </form>
    </div>
  </div>
  
</section>


@endsection
