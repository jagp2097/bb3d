@extends('layouts.app')
@section('content')

@if (session('coupon_status'))
<div class="container alert alert-info" role="alert">
  {{ session('coupon_status') }}
</div>
@endif


<section id="clients">

    <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-8 mx-auto">
              
                    <div class="section-header">
                      <h5>Productos que adquirió</h5>
                    </div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <th class="text-center" scope="col">Paquete</th>
                          <th class="text-center" scope="col">Cantidad</th>
                          <th class="text-center" scope="col">Precio</th>

                        </thead>
                        <tbody>
                          @foreach ($cupon->cupon_pedido as $paquete_cupon)
                          <tr>
                            <td class="align-middle text-center">{{ $paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->nombre }}</td>
                            <td class="align-middle text-center">{{ $paquete_cupon->cantidad }}</td>
                            <td class="align-middle text-center">${{ $paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->precio }}</td>
                            {{-- <td class="align-middle text-center">${{ $row->tax }}</td> --}}
                            {{-- <td class="align-middle text-center">${{ $row->subtotal }}</td> --}}
                            {{-- <td class="align-middle text-center">${{ $row->total }}</td> --}}
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <br>
              </div>
            </div>
          </div>
        </div>
    </div>


  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <form id="payment-form" action="{!! route('coupon.cuponpedido', $cupon->id) !!}" method="post" enctype="multipart/form-data">
              {{ csrf_field() }}
              
              {{-- Carga de archivos --}}
              <?php // TODO: Solo se permitiran estos tipos de archivos .vol, .v00,.vzz,.vff,.mvl,.obj,.stl ?>
              <section id="contact">
                <div class="section-header">
                  <h5>Carga de archivos</h5>
                </div>
                
                <div class="form">
                  
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group col-md-12">
                        <label for="">Pedido a nombre</label>
                        <input class="form-control{{ $errors->has('pedido_nombre') ? ' is-invalid' : '' }}" type="text" name="pedido_nombre" value="{{ old('pedido_nombre') }}"/>
                        
                        @if ($errors->has('pedido_nombre'))
                        <span class="help-block ">
                          <small class="text-danger">{{ $errors->first('pedido_nombre') }}</small>
                        </span>
                        @endif
                        
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group col-md-12">
                        <label for="">E-mail</label>
                        <input class="form-control{{ $errors->has('pedido_email') ? ' is-invalid' : '' }}" type="text" name="pedido_email" value="{{ Auth::user()->email }}" readonly/>
                        
                        @if ($errors->has('pedido_email'))
                        <span class="help-block ">
                          <small class="text-danger">{{ $errors->first('pedido_email') }}</small>
                        </span>
                        @endif
                        
                      </div>
                    </div>
                  </div>
                  
                  <hr>
                  
                  @php
                  $entregables = array();
                  @endphp
                  @foreach ($cupon->cupon_pedido as $paquete_cupon)
                    @php
                      array_push($entregables, $paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->entregable);
                    @endphp
                  @endforeach
                   
                    @if (in_array(1, $entregables))
                    <div class="row">
                      <div class="col-md-12">
                        <div class="section-header">
                          <h5>Envío del paquete</h5>
                        </div>
                        <p>Por favor llene el siguiente formulario para enviar el(los) paquete(s)
                          @foreach ($cupon->cupon_pedido as $paquete_cupon)
                          @if ($paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->entregable == 1)
                          <strong>{{ $paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->nombre }},</strong>
                          @endif
                          @endforeach
                        </p>
                        
                        <div class="form-group">
                          <div class="row m-1">
                            <div class="col-md-6">
                              <label for="">Estado</label>
                              <input class="form-control{{ $errors->has('pedido_estado') ? ' is-invalid' : '' }}" type="text" name="pedido_estado" value="{{ old('pedido_estado') }}"/>
                              
                              @if ($errors->has('pedido_estado'))
                              <span class="help-block ">
                                <small class="text-danger">{{ $errors->first('pedido_estado') }}</small>
                              </span>
                              @endif
                              
                            </div>
                            <div class="col-md-6">
                              <label for="">Ciudad</label>
                              <input class="form-control{{ $errors->has('pedido_ciudad') ? ' is-invalid' : '' }}" type="text" name="pedido_ciudad" value="{{ old('pedido_ciudad') }}"/>
                              
                              @if ($errors->has('pedido_ciudad'))
                              <span class="help-block ">
                                <small class="text-danger">{{ $errors->first('pedido_ciudad') }}</small>
                              </span>
                              @endif
                              
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="row m-1">
                            <div class="col-md-6">
                              <label for="">Código postal</label>
                              <input class="form-control{{ $errors->has('pedido_codigo_postal') ? ' is-invalid' : '' }}" type="text" name="pedido_codigo_postal" value="{{ old('pedido_codigo_postal') }}"/>
                              
                              @if ($errors->has('pedido_codigo_postal'))
                              <span class="help-block ">
                                <small class="text-danger">{{ $errors->first('pedido_codigo_postal') }}</small>
                              </span>
                              @endif
                              
                            </div>
                            <div class="col-md-6">
                              <label for="">Colonia</label>
                              <input class="form-control{{ $errors->has('pedido_colonia') ? ' is-invalid' : '' }}" type="text" name="pedido_colonia" value="{{ old('pedido_colonia') }}"/>
                              
                              @if ($errors->has('pedido_colonia'))
                              <span class="help-block ">
                                <small class="text-danger">{{ $errors->first('pedido_colonia') }}</small>
                              </span>
                              @endif
                              
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="row m-1">
                            <div class="col-md-6">
                              <label for="">Calle</label>
                              <input class="form-control{{ $errors->has('pedido_calle') ? ' is-invalid' : '' }}" type="text" name="pedido_calle" value="{{ old('pedido_calle') }}"/>
                              
                              @if ($errors->has('pedido_calle'))
                              <span class="help-block">
                                <small class="text-danger">{{ $errors->first('pedido_calle') }}</small>
                              </span>
                              @endif
                              
                            </div>
                            <div class="col-md-6">
                              <label for="">Número</label>
                              <input class="form-control{{ $errors->has('pedido_numero') ? ' is-invalid' : '' }}" type="text" name="pedido_numero" value="{{ old('pedido_numero') }}"/>
                              
                              @if ($errors->has('pedido_numero'))
                              <span class="help-block">
                                <small class="text-danger">{{ $errors->first('pedido_numero') }}</small>
                              </span>
                              @endif
                              
                            </div>
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <div class="row m-1">
                            <label for="">Referencia del lugar</label>
                            <textarea class="form-control{{ $errors->has('pedido_referencia_direccion') ? ' is-invalid' : '' }}" type="text" name="pedido_referencia_direccion">{{ old('pedido_referencia_direccion') }}</textarea>
                            
                            @if ($errors->has('pedido_referencia_direccion'))
                            <span class="help-block ">
                              <small class="text-danger">{{ $errors->first('pedido_referencia_direccion') }}</small>
                            </span>
                            @endif
                            
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    
                    @foreach ($cupon->cupon_pedido as $paquete_cupon)
                    <div class="row">
                      <div class="col-lg-3 col-md-3 col-sm-3 my-auto text-center">
                        <img src="{!! asset('images/') !!}/{{  $paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->foto }}" alt="">
                      </div>
                      <div class="col-lg-5 col-md-5 col-sm-5 my-auto">
                        <label for="">Comentario (opcional)</label><br>
                        <textarea class="form-control" type="text" name="comentario_pedido[]">{{ old('comentario_pedido[]') }}</textarea>
                        @if ( $paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->entregable)
                        <small>*Este paquete le <strong>será enviado</strong> a la dirección que ha indicado en el formulario anterior.</small>
                        @else
                        <small>*Este paquete le proveerá un archivo que aparecerá en la sección <strong>Mis archivos</strong> de su perfil.</small>
                        @endif
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 my-auto">
                        @if ( $paquete->where('id', '=', $paquete_cupon->paquete_id)->first()->entregable)
                        <input type="file" class="form-control-file" name="archivo_pedido_enviar[]" accept=".vol" required>
                        @if ($errors->has('archivo_pedido_enviar'))
                        <span class="help-block ">
                          <small class="text-danger">{{ $errors->first('archivo_pedido_enviar') }}</small>
                        </span>
                        @endif
                        @else
                        <input type="file" class="form-control-file" name="archivo_pedido[]" accept=".vol" required>
                        @if ($errors->has('archivo_pedido'))
                        <span class="help-block ">
                          <small class="text-danger">{{ $errors->first('archivo_pedido') }}</small>
                        </span>
                        @endif
                        @endif
                      </div>
                    </div>
                    <hr>
                    @endforeach
                  </div>
                  <div class="text-right mt-4">
                    <a href="{!! route('cart.content') !!}" class="btn-sec">Regresar</a>
                    <button class="btn-mod-ver" type="submit" id="pay-button">Completar pedido</button>
                  </div>
                </section>
                
              </form>
            </div>
            
            
            
          </div>
          
        </div>            
      </div>
    </div>
  </section>
@endsection
  