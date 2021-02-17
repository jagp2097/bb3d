@extends('layouts.app')

@section('scripts')
<script src="{{ asset('js/productos-specs.js') }}"></script>
@endsection

@section('content')

<div id="erroresMedida"></div>

<section id="contact">
    <div class="container">
        <div class="section-header">            
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6">
                    <h4>Medidas</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="payment-step-paragraph">Selecciona una de las medidas disponibles para tu Bb3D.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="productos" class="products-bb3d" style="padding:0 25px;">
    @foreach ($productos as $row)
    
    <div class="row">
        <div class="col-md-3">
            <img style="width:100%;" src="{{ asset('images/productos') }}/{{ $row->options->imagen_paquete }}" alt="">
        </div>
        <div class="col-md-9">
            <div id="{{ $row->rowId }}" class="row">
                <div class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <p class="product-price"><small>Bb3D</small></p>
                        <h3 class="product-title">4 cm * 6 cm</h3>
                        <p class="product-paragraph">Bb3D</p>            
                    </div>
                </div>
                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <p class="product-price"><small>Bb3D</small></p>
                        <h3 class="product-title">6 cm * 8 cm</h3>
                        <p class="product-paragraph">+ 150.00 MX</p>
                    </div>
                </div>
                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <p class="product-price"><small>Bb3D</small></p>
                        <h3 class="product-title">8 cm * 10 cm</h3>
                        <p class="product-paragraph">+ 300.00 MX</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    @endforeach

    <div class="row py-5">
        <div class="col-lg-12 text-right">
            @php
                $cont_items_row = Cart::content()->count();
            @endphp
            <button class="btn-sec" type="button" onclick="continueProcessMedida({{ $cont_items_row }}, '{{ route('paquete.medidas-post') }}', '{{ route('paquete.bases') }}');"> Continuar </button>
        </div>
    </div>


</section>

@endsection