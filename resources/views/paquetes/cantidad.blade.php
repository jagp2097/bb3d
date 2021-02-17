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
                    <h4>Cantidad</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="payment-step-paragraph">Elige cuantos Bb3D quieres comprar.</p>
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
                        <p class="product-price"><small>Cantidad</small></p>
                        <h3 class="product-title">1</h3>
                        <p class="product-paragraph">Bb3D</p>                   
                    </div>
                </div>

                @php
                    // $d3 = 0;
                    $precio = (float) $producto->findOrFail($row->id)->precio;
                    $d3 = ($precio * 3) * 0.642 + 40;
                @endphp
                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <p class="product-price"><small>Cantidad</small></p>
                        <h3 class="product-title">3</h3>
                        <p class="product-paragraph">+ {{ ceil($d3 - $precio) }} MX</p>
                    </div>
                </div>

                @php
                    // $d5 = 0;
                    $d5 = ($precio * 5) * 0.558;
                @endphp
                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <p class="product-price"><small>Cantidad</small></p>
                        <h3 class="product-title">5</h3>
                        <p class="product-paragraph">+ {{ ceil($d5 - $precio) }} MX</p>
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
            <button class="btn-sec" type="button" onclick="continueProcessCantidad({{ $cont_items_row }}, '{{ route('paquete.cantidades-post') }}', '{{ route('paquete.calculos') }}');"> Continuar </button>
        </div>
    </div>

</section>


@endsection
