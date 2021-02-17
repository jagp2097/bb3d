@extends('layouts/app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Perfil</div>
                    <div class="card-body">
                      <div class="row">

                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="col-md-9 control-label" for="">Nombre del paquete: {{ $paquete->nombre }}</label><br>
                            <label class="col-md-9 control-label" for="">Descripción de la paquete: {{ $paquete->descripcion }}</label><br>
                            <label class="col-md-9 control-label" for="">Precio: {{ $paquete->precio }}</label><br>
                          </div>
                        </div>

                        <div class="col-md-6">
                            <a class="btn btn-sm btn-warning" href="{!! route('compra.form', $paquete) !!}">Comprar</a>
                        </div>

                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
