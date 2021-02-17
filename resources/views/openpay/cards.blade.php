@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/elementos_w3css.js') }}"></script>
@endsection
@section('content')

@if (session('status_card'))
<div class='alert alert-info' role='alert'>
  {{ session('status_card') }}
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
@endif

{{-- {{dd($cards)}} --}}
<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <div class="section-header">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <h4>Mis tarjetas guardadas</h4>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-right">
              <div class="row">
                <div class="col-lg-12 justify-content-center">
                  <div class="col-lg-12 justify-content-center">
                    <a href="{{ route('perfil.show') }}" class="btn-sec" role="button"> Perfil </a>
                    <a role="button" href="{{ route('card.add') }}" class="btn-edit">Añadir tarjeta</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        
        <section id="services-mod">
          <div class="container">
            <div class="row">
              @foreach ($cards as $card)
              
              <div class="col-lg-6 justify-content-center">
                <div class="box">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="icon-card mt-4 mb-5 text-center">
                        @switch($card->brand)
                        @case('visa')
                        <i class="fab fa-cc-visa icon-card"></i>
                        @break
                        
                        @case('mastercard')
                        <i class="fab fa-cc-mastercard icon-card"></i>
                        @break
                        
                        @case('american_express')
                        <i class="fab fa-cc-amex icon-card"></i>
                        @break
                        
                        @default
                        <i class="far fa-credit-card icon-card"></i>
                        @endswitch
                      </div>
                    </div>
                    
                    <div class="col-lg-9">
                      <div class="card-info">
                        <p class="description"><span>Número de la tarjeta:</span> {{ $card->serializableData['card_number'] }}</p>
                        <p class="description"><span>Nombre en la tarjeta:</span> {{ $card->serializableData['holder_name'] }}</p>
                        <p class="description"><span>Tipo de tarjeta:</span> {{ $card->type }}</p>
                        <p class="description"><span>Banco:</span> {{ $card->bank_name}}</p>
                        <p class="description"><span>Fecha de expiración:</span> {{ $card->serializableData['expiration_month'] }}/{{ $card->serializableData['expiration_year'] }}</p>
                      </div>
                      
                      <div class="text-right">
                        <button class="btn-del borrar-arch "type="button" onclick="abrir_modal_eliminar_card('{!! route('openpay.deleteCard', $card->id) !!}', '{{ $card->serializableData['card_number'] }}')">Eliminar</button>
                      </div>
                      
                      {{-- <h4 class="title"><a role="button" href="#"></a></h4> --}}
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>

<div id="modal_eliminar_card" class="w3-modal w3-animate-opacity">
  <section id="contact">
    <div class="w3-modal-content w3-card-2">
      <span onclick="cerrar_modal_eliminar_card()" class="w3-button w3-large w3-display-topright">&times;</span>
      <div class="w3-container w3-padding-large w3-padding-24">
        <div class="section-header">
          <h4>Eliminar archivo</h4>
        </div>
        
        <div class="row container w3-padding justify-content-center">
          <div id="text_modal" class="col-md-9 text-center">
            
          </div>
        </div>
        
        <div class="row container text-center w3-padding-large">
          <div class="col-md-12">
            
            <form id="form-borrar-card" class="text-center" method="post">
              {{ csrf_field() }}
              @method('DELETE')
              <button type="submit" class="btn-del">Si, eliminar tarjeta</button>
              <button type="button" onclick="cerrar_modal_eliminar_card()" class="btn-sec">No, conservar tarjeta</button>          
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>  
</div>


@endsection
