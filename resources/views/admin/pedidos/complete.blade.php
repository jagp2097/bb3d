@extends("layouts.app")
@section("content")

@if (session('errors_complete'))
<div class="container alert alert-danger" role="alert">
  {{ session('errors_complete') }}
</div>
@endif

<section id="clients">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 justify-content-center">
                <div class="section-header">
                    <h4>Completar pedido</h5>
                </div>                        
            </div>
        </div>
    </div>
    
    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div>
            
            <div class="row container">
                <div class="col-lg-11 justify-content-center mx-auto">
                    <div style="margin-bottom:10px;" class="section-header">
                        <h5 class="title-xs">Información del pedido</h5>
                    </div>
                    <div class="info-pedido">
                        <p><span>Pedido a nombre:</span> {{ $pedido->pedido_nombre }}</p>
                        <p><span>Creación del pedido:</span> {{ $pedido->created_at->format('Y-m-d') }}</p>
                    </div>
                </div>
                <hr>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-3 text-center my-auto">
                    <div style="margin-bottom:5px;" class="section-header">
                        <h5 class="title-xs">Archivo cargado</h5>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                </div>
            </div>
            <div class="info-pedido">
                @foreach ($pedido->paquetes as $paquete)
                <div class="row">
                    
                    <div class="col-md-5 my-auto text-center">
                        <div class="row">
                            <div class="col-md-5 text-center">
                                <img src="{{ asset('images/productos') }}/{{ $paquete->foto }}" alt="">
                            </div>
                            <div class="col-md-7 my-auto">
                                <p><strong>Descripción: </strong>{{ $paquete->descripcion }}</p>
                            </div>
                        </div>
                        
                        @if ($paquete->entregable == 1)
                        <small>*Este paquete <strong>deberá ser enviado</strong> a la dirección que ha indicado el cliente.</small>
                        @else
                        <small>*Este paquete le proveerá un archivo al cliente y aparecerá en la sección <strong>Mis archivos</strong> de su perfil.</small>
                        @endif
                    </div>
                    
                    <div class="col-md-3 my-auto text-center">
                            {{ $paquete->pivot->archivo }}
                        {{-- <img style="width:80%" src="{{ asset('images/') }}/{{ $paquete->pivot->archivo }}" alt=""> --}}
                        @if ($paquete->pivot->comentario != null)
                            <p><span>Comentario:</span>{{ $paquete->pivot->comentario }}</p>
                        @endif
                    </div>
                    
                    @if ($paquete->entregable == 1)
                    
                    <div class="col-md-4 my-auto ">
                        <div class="section-header text-center">
                            <h5 class="title-xs">Dirección de envio</h5>
                        </div>
                        <p><span>Dirección de envio: </span>{{ $paquete->pivot->pedido_ciudad.", ".$paquete->pivot->pedido_estado.", C.P. ".$paquete->pivot->pedido_codigo_postal.", Col. ".$paquete->pivot->pedido_colonia.", ".$paquete->pivot->pedido_direccion }}</p>
                        <p><span>Referencia del lugar: </span>{{ $paquete->pivot->pedido_referencia_direccion }}</p>
                        {{-- <input type="file" name="archivo_pedido_completado " id=""> --}}
                    </div>       
                    
                    @else   
                    <div class="col-md-4 my-auto text-center">
                        <div class="section-header">
                            <h5 class="title-xs">Subir archivo</h5>
                        </div>
                        
                        <input class="form-control-file" type="file" name="archivo_pedido_completado[]" id="">
                        {{-- <img src="{{ asset('images/') }}/{{ $paquete->pivot->archivo }}" alt=""> --}}
                    </div>
                    
                    @endif
                    
                    
                </div>
                <hr>
                @endforeach
            </div>
        </div>
        
        <div class="text-right mt-4">
            <a href="{!! route('pedidos.show', $pedido->id) !!}" class="btn-sec">Regresar</a>
            <button class="btn-edit" type="submit">Completar pedido</button>
        </div>    
    </form>
           
</section>

@endsection