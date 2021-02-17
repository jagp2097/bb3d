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
                    <h4>Bases / Cuadro</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="payment-step-paragraph">Selecciona una de las bases en la que entregaremos tu Bb3D.</p>
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

                @if($row->name == 'Cuadro')
                <div class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <img src="{{ asset('images/pagina/cuadros/cuadro_tono_oscuro_2.png') }}" alt="">
                        <h3 class="product-title">Cuadro de color obscuro</h3>
                        <p class="product-paragraph">Bb3D en cuadro de color obscuro</p>                
                    </div>
                </div>


                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <img src="{{ asset('images/pagina/cuadros/cuadro_tono_medio_2.png') }}" alt="">
                        <h3 class="product-title">Cuadro de color medio</h3>
                        <p class="product-paragraph">Bb3D en cuadro de color medio</p>
                    </div>
                </div>


                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <img src="{{ asset('images/pagina/cuadros/cuadro_tono_claro_2.png') }}" alt="">
                        <h3 class="product-title">Cuadro de color claro</h3>
                        <p class="product-paragraph">Bb3D en cuadro de color claro</p>
                    </div>
                </div>

                @elseif($row->name == 'Acrílico' || $row->name == 'ABS')
                <div class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <img src="{{ asset('images/pagina/bases/base_flecha.png') }}" alt="">
                        <h3 class="product-title">Flecha</h3>
                        <p class="product-paragraph">Base en forma de flecha</p>                
                    </div>
                </div>


                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <img src="{{ asset('images/pagina/bases/base_estrella.png') }}" alt="">
                        <h3 class="product-title">Estrella</h3>
                        <p class="product-paragraph">Base en forma de estrella</p>
                    </div>
                </div>


                <div id="{{ $row->rowId }}" class="col-md-4" style="cursor:pointer;">
                    <div class="box" onclick="selectOpcion(this);" data-product="{{ $row->rowId }}">
                        <img src="{{ asset('images/pagina/bases/base_diamante.png') }}" alt="">
                        <h3 class="product-title">Diamante</h3>
                        <p class="product-paragraph">Base en forma de diamante</p>
                    </div>
                </div>
                @endif


                    



            </div>
        </div>
    </div>
        
    @endforeach

    <div class="row py-5">
        <div class="col-lg-12 text-right">
            @php
                $cont_items_row = Cart::content()->count();
            @endphp
            <button class="btn-sec" type="button" onclick="continueProcessBase({{ $cont_items_row }}, '{{ route('paquete.bases-post') }}', '{{ route('paquete.cantidad') }}');"> Continuar </button>
        </div>
    </div>

</section>

@endsection