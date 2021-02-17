@extends('layouts.app')
@section('content')

@if (session('errors'))
<div class="alert alert-danger" role="alert">
    {{ session('errors') }}
</div>
@endif


<section class="clients">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 justify-content-center">
                <div class="section-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            @if($cupon->exists)
                            <h4>Editar cupón</h4>
                            @else
                            <h4>Crear cupón</h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="row">
            <div class="col-lg-12 justify-content-center form">
                
                @if ($cupon->exists)
                <form action="{{ route('coupon.update', $cupon) }}" method="POST">
                    @method('PUT')
                    @csrf
                @else
                <form action="{{ route('coupon.store') }}" method="POST">
                    @csrf
                @endif
                        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-10">
                                <label for="">Código del cupón</label>
                                @if ($cupon->exists)
                                <input class="form-control" type="text" name="cupon_codigo" value="{{ $cupon->codigo }}"/>
                                @else
                                <input class="form-control" type="text" name="cupon_codigo" value=""/>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group col-md-6">
                                
                                <label for="">Fecha de vencimiento del cupón</label>
                                
                                @if ($cupon->exists)
                                <input type="hidden" name="date_inicio" value="{{ $cupon->fecha_inicio }}">
                                
                                <input class="form-control" type="date" name="date_vencimiento" 
                                value="{{ $cupon->fecha_fin }}" 
                                min="{{$fecha->format('Y-m-d')}}" max="2220-12-31">
                                
                                @else
                                <input type="hidden" name="date_inicio" value="{{ $fecha->format('Y-m-d') }}">
                                
                                <input class="form-control" type="date" name="date_vencimiento" 
                                value="{{$fecha->addDay()->format('Y-m-d')}}" 
                                min="{{$fecha->format('Y-m-d')}}" max="2220-12-31">
                                @endif
                                
                                
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="col-md-6">
                                <label class="form-check-label">Tipo de cupón</label>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group col-md-12">
                                <div class="container">
                                    
                                    <div class="row">
                                        <div class="col-md-6 pl-4">
                                            <label for="">
                                                <input id="1" class="form-check-input radio-cupon" type="radio" name="tipo_cupon" value="descuento_porcentaje"
                                                @if ($cupon->exists && $cupon->tipo_cupon == 'descuento_porcentaje')
                                                    checked
                                                @elseif ($cupon->exists && $cupon->tipo_cupon == 'descuento_efectivo')
                                                @else
                                                    checked
                                                @endif
                                                >
                                                Descuento por porcentaje 
                                            </label>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <input id="input-cupon-1" type="number" min="1" max="100" name="cupon_descuento_porcentaje"
                                            @if ($cupon->exists && $cupon->tipo_cupon == 'descuento_porcentaje')
                                                value="{{ $cupon->porcentaje_descuento }}"
                                            @elseif ($cupon->exists && $cupon->tipo_cupon == 'descuento_efectivo')
                                                value="1"
                                                disabled
                                            @else
                                                value="1"
                                            @endif 
                                            >
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 pl-4">
                                            <label for="">
                                                <input id="2" class="form-check-input radio-cupon" type="radio" name="tipo_cupon" value="descuento_efectivo"
                                                @if ($cupon->exists && $cupon->tipo_cupon == 'descuento_efectivo')
                                                checked
                                                @elseif ($cupon->exists && $cupon->tipo_cupon == 'descuento_porcentaje')
                                                @else
                                                @endif
                                                >
                                                Descuento por cantidad de dinero 
                                            </label>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <input id="input-cupon-2" type="number" min="1" name="cupon_descuento_efectivo" 
                                            @if ($cupon->exists && $cupon->tipo_cupon == 'descuento_efectivo')
                                            value="{{ $cupon->valor_descuento }}"
                                            @elseif ($cupon->exists && $cupon->tipo_cupon == 'descuento_porcentaje')
                                                value="1"
                                                disabled
                                            @else
                                                value="1"
                                                disabled
                                            @endif
                                            >
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row float-right">
                        <a href="{{ route('coupon.index') }}" class="btn-edit">Ver cupones</a>
                        
                        @if ($cupon->exists)
                        <button class="btn-back" type="submit">Editar cupón</button>
                        @else
                        <button class="btn-back" type="submit">Crear cupón</button>
                        @endif
                        
                    </div>
                        
                </form>    
                    
            </div>

        </div>
    </div>
</section>
    
    
    @section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            
            var radios = document.getElementsByClassName('radio-cupon');
            var radioChecked;
            var inputEnabled;
            
            if (Boolean({{ !$cupon->exists }})) {

                var radioChecked = radios[0];
                var inputEnabled = document.getElementById('input-cupon-1');
                
            } else if (Boolean({{ $cupon->exists }}) && '{{ $cupon->tipo_cupon }}' == 'descuento_porcentaje') {

                var radioChecked = radios[0];
                var inputEnabled = document.getElementById('input-cupon-1');
                
            } else if (Boolean({{ $cupon->exists }}) && '{{ $cupon->tipo_cupon }}' == 'descuento_efectivo') {

                var radioChecked = radios[1];
                var inputEnabled = document.getElementById('input-cupon-2');

            }
            
            Array.from(radios).forEach(element => {
                element.addEventListener('change', function() {
                    
                    if(element.checked && radioChecked == '') {
                        
                        document.getElementById('input-cupon-'+element.id).disabled = false; 
                        
                        radioChecked = element;
                        inputEnabled = document.getElementById('input-cupon-'+element.id);
                        
                    } else if(element.checked && radioChecked != element) {
                        
                        document.getElementById('input-cupon-'+element.id).disabled = false; 
                        
                        inputEnabled.disabled = true;
                        
                        radioChecked = element;
                        inputEnabled = document.getElementById('input-cupon-'+element.id);
                        
                    } else {
                        
                        document.getElementById('input-cupon-'+element.id).disabled = true; 
                        
                    }
                    
                    
                });
            });
                    
        });
                
            </script>
            @endsection
            
            @endsection
            
            