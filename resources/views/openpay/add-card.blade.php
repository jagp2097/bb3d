@extends('layouts.app')
@section('content')

@section('scripts')
<script src="{{ asset('js/scriptMask.js') }}"></script>

<script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>

<script type="text/javascript">
  // TODO: Agregar las funciones de validacion a la tarjeta
  $(document).ready(function() {
    OpenPay.setId('mj7glzez1snwbqq4lcfz');
    OpenPay.setApiKey('pk_ca4d30bf53d1422a973c5837b3bb57ae');
    OpenPay.setSandboxMode(true);
    
    var deviceDataId = OpenPay.deviceData.setup("create-card-form", "deviceIdHiddenFieldName");
    
    $('#createCardBtn').on('click', function (event) {
      event.preventDefault();
      $("#createCardBtn").prop( "disabled", true);
      
      OpenPay.card.validateCardNumber( $('#card_number').val() );
      OpenPay.card.validateCVC( $('#cvv2').val() );
      OpenPay.card.validateExpiry( $('#expiration_month').val(), $('#expiration_year').val() );
      OpenPay.card.cardType( $('#card_number').val() );
      
      OpenPay.token.extractFormAndCreate('create-card-form', success_callbak, error_callbak);
    });
    
    var success_callbak = function(response) {
      var token_id = response.data.id;
      $('#token_id').val(token_id);
      console.log(token_id);
      $('#create-card-form').submit();
      
    };
    
    var error_callbak = function(response) {
      var desc = response.data.description != undefined ? response.data.description : response.message;
      // alert("ERROR [" + response.status + "] " + desc);
      
      $('html, body').animate({scrollTop:0}, 'slow');
      $('#cardErrors').append('<div id="errors" class="container alert alert-danger" role="alert">ERROR [' + response.status + '] ' + desc +'</div>');
      $('#errors').delay(3000).fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
      
      $("#createCardBtn").prop("disabled", false);
    };
    
  });
  
</script>

@endsection

<div id="cardErrors"></div>


<section id="clients" class="payment-step mx-auto my-5">
  
  <div class="section-header">
    <h4 class="ml-5">Agregar tarjeta</h4>
  </div>
  
  <div class="row justify-content-center">
    <div class="col-md-10">        
      <div class="form">
        
        <form id="create-card-form" class="" action="{{ route('openpay.addCard') }}" method="post">
          {{ csrf_field() }}
          {{-- Id tarjeta --}}
          <input type="hidden" name="token_id" id="token_id">
          
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
              
              <div class="col-md-5">
                <label for="holder_name" class="col-md-10">Nombre del titular *</label>
                <div class="col-md-12">
                  <input type="text" placeholder="Igual que en la tarjeta" data-openpay-card="holder_name" name="holder_name" id="holder_name" class="form-control" value="{{ old('holder_name') }}"/>
                </div>
              </div>
              
              <div class="col-md-5">
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
                  <input id="expiration_month" type="text" placeholder="Mes Ejemplo: 03" data-openpay-card="expiration_month" name="expiration_month" class="form-control" value="{{ old('expiration_month') }}"/>
                </div>
              </div>
              
              <div class="col-md-4">
                <label for="expiration_year" class="col-md-10">Año de expiración*</label>
                <div class="col-md-12">
                  <input id="expiration_year" type="text" placeholder="Año Ejemplo: 88" data-openpay-card="expiration_year" name="expiration_year" class="form-control" value="{{ old('expiration_year') }}"/>
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
          
          <div class="justify-content-center text-center">
            <a href="{{ route('openpay.getCards') }}" role="button" class="previous btn-back">Regresar</a>
            <button id="createCardBtn" type="button" class="next btn-sec">Agregar tarjeta</button>
          </div>
          
        </form> 
        
      </div>
    </div>
  </div>
  
</section>

@if (session('errors_card'))
<div class="container alert alert-danger">
  {{ session('errors_card') }}
</div>
@endif

@endsection
