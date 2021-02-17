@extends('layouts.app')
@section('content')

<section id="clients">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 justify-content-center">
                <div class="section-header">
                    <h4>Cupón</h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row container">
        
        <div class="col-lg-11 justify-content-center mx-auto">
            
            <div class="row">
                <div class="col-md-5 my-auto">
                    <div style="margin-bottom:10px;" class="section-header">
                        <h5 class="title-xs">Código: </h5>
                    </div>
                    
                    <h3>{{ $cupon->codigo }}</h3>
                    
                </div>
            </div>
            
            <br>
            
            <div style="margin-bottom:10px;" class="section-header">
                <h5 class="title-xs">Contenido del Cupón</h5>
            </div>
            
            <hr>
            
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5"></div>
            </div>
            <div class="info-pedido">
                @foreach ($cupon->cupon_pedido as $paquete_cupon)
                <div class="row">
                    <div class="col-md-3 my-auto text-center">
                        <img src="{{ asset('images/productos') }}/{{ $paquete->where('id', $paquete_cupon->paquete_id)->first()->foto }}" alt="">
                    </div>
                    <div class="col-md-5 my-auto">
                        
                        <p><span>Paquete: </span>{{ $paquete->where('id', $paquete_cupon->paquete_id)->first()->foto }}</p>
                        
                        <p><span>Descripción: </span>{{ $paquete->where('id', $paquete_cupon->paquete_id)->first()->descripcion }}</p>
                        <p><span>Precio: </span>${{ $paquete->where('id', $paquete_cupon->paquete_id)->first()->precio }}</p>
                        <p><span>Cantidad: </span>{{ $paquete_cupon->cantidad }}</p>
                        
                    </div>
                    
                </div>
                <hr>
                @endforeach
            </div>        
            
            <div class="float-right">
                <div class="row">
                    <div class="col-lg-12 justify-content-center">
                        <a class="btn-sec" href="{{ route('coupon.index') }}">Ver todos los cupones</a>
                        <button onclick="window.print()" class="btn-edit"><i class="fa fa-print"></i>Print</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </section>
    
    {{-- {{ $cupon }} --}}
    
    
    
    
    @endsection