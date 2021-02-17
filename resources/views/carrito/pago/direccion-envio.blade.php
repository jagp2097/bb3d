@extends('layouts.app')
@section('scripts')
<script type="text/javascript" src="{!! asset('js/elementos-confirmar.js') !!}"></script>
<script src="{{ asset('js/scriptMask.js') }}"></script>

@endsection
@section('content')

@if($errors->any())
<div class="container alert alert-danger" role="alert">
  @foreach ($errors->all() as $error)
  <ul>
    <li>{{ $error }}</li>
  </ul>
  @endforeach
</div>    
@endif

<section id="clients" class="payment-step mx-auto my-5">

  <div class="section-header">
    <h4 class="ml-5">Dirección de envío</h4>
  </div>

  <div class="row justify-content-center mt-5 mb-4">
    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
      <i class="ion-android-home payment-step-icon"></i>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
      <p class="payment-step-paragraph">Elige una dirección a donde se enviará tu pedido, puedes elegir una de las que haz guardado o introducir una diferente.</p> 
    </div>
  </div>
  
  <div class="row justify-content-center">
    <div class="col-md-10">

      <div class="form">
        <form id="direccion-form" action="{{ route('pago.direccion-post') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="pedido_email" value="{{ Auth::user()->email }}"/>
          <input type="hidden" value="{{ Auth::user()->perfil->fullname }}"/>
          
          {{-- SI NO HAY DIRECCIONES GUARDADAS --}}
          @if($direcciones->isEmpty())
          <div class="row form">
            <div class="col-md-12 ">
              @if (sizeof($carrito) > 1)
              <p>Por favor llene el siguiente formulario para enviar los productos
                @foreach ($carrito as $row)
                @if ($row->options['entregable'] == 1)
                <strong>{{ $row->name }},</strong>
                @endif
                @endforeach
                .</p>
                
                @elseif(sizeof($carrito) == 1)
                <p>Por favor llene el siguiente formulario para enviar el producto
                  @foreach ($carrito as $row)
                  @if ($row->options['entregable'] == 1)
                  <strong>{{ $row->name }}.</strong>
                  @endif
                  @endforeach
                </p>
                @endif
                
                <div class="form-group">
                  <div class="row m-1">
                    <div class="col-md-4">
                      <label for="">Estado</label>
                      <input id="estado" class="form-control{{ $errors->has('pedido_estado') ? ' is-invalid' : '' }}" type="text" name="pedido_estado" value="{{ old('pedido_estado') }}"/>
                      
                      @if ($errors->has('pedido_estado'))
                      <span class="help-block ">
                        <small class="text-danger">{{ $errors->first('pedido_estado') }}</small>
                      </span>
                      @endif
                      
                    </div>
                    <div class="col-md-4">
                      <label for="">Ciudad</label>
                      <input id="ciudad" class="form-control{{ $errors->has('pedido_ciudad') ? ' is-invalid' : '' }}" type="text" name="pedido_ciudad" value="{{ old('pedido_ciudad') }}"/>
                      
                      @if ($errors->has('pedido_ciudad'))
                      <span class="help-block ">
                        <small class="text-danger">{{ $errors->first('pedido_ciudad') }}</small>
                      </span>
                      @endif
                      
                    </div>
                    <div class="col-md-4">
                      <label for="">Código postal</label>
                      <input id="cp" class="form-control{{ $errors->has('pedido_codigo_postal') ? ' is-invalid' : '' }}" type="text" name="pedido_codigo_postal" value="{{ old('pedido_codigo_postal') }}"/>
                      
                      @if ($errors->has('pedido_codigo_postal'))
                      <span class="help-block ">
                        <small class="text-danger">{{ $errors->first('pedido_codigo_postal') }}</small>
                      </span>
                      @endif
                      
                    </div>
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row m-1">
                    
                    <div class="col-md-4">
                      <label for="">Colonia</label>
                      <input id="colonia" class="form-control{{ $errors->has('pedido_colonia') ? ' is-invalid' : '' }}" type="text" name="pedido_colonia" value="{{ old('pedido_colonia') }}"/>
                      
                      @if ($errors->has('pedido_colonia'))
                      <span class="help-block ">
                        <small class="text-danger">{{ $errors->first('pedido_colonia') }}</small>
                      </span>
                      @endif
                      
                    </div>
                    <div class="col-md-4">
                      <label for="">Calle</label>
                      <input id="calle" class="form-control{{ $errors->has('pedido_calle') ? ' is-invalid' : '' }}" type="text" name="pedido_calle" value="{{ old('pedido_calle') }}"/>
                      
                      @if ($errors->has('pedido_calle'))
                      <span class="help-block ">
                        <small class="text-danger">{{ $errors->first('pedido_calle') }}</small>
                      </span>
                      @endif
                      
                    </div>
                    <div class="col-md-4">
                      <label for="">Número</label>
                      <input id="numero" class="form-control{{ $errors->has('pedido_numero') ? ' is-invalid' : '' }}" type="text" name="pedido_numero" value="{{ old('pedido_numero') }}"/>
                      
                      @if ($errors->has('pedido_numero'))
                      <span class="help-block ">
                        <small class="text-danger">{{ $errors->first('pedido_numero') }}</small>
                      </span>
                      @endif
                      
                    </div>
                    
                  </div>
                </div>
                
                <div class="form-group">
                  <div class="row m-1">
                    <label for="">Referencia del lugar</label>
                    <textarea id="pedido_referencia_direccion" class="form-control{{ $errors->has('pedido_referencia_direccion') ? ' is-invalid' : '' }}" type="text" name="pedido_referencia_direccion">{{ old('pedido_referencia_direccion') }}</textarea>
                    
                    @if ($errors->has('pedido_referencia_direccion'))
                    <span class="help-block ">
                      <small class="text-danger">{{ $errors->first('pedido_referencia_direccion') }}</small>
                    </span>
                    @endif
                    
                  </div>
                </div>
              </div>
            </div>
            {{-- FIN SI NO HAY DIRECCIONES GUARDADAS --}}
            {{-- SI HAY DIRECCIONES GUARDADAS --}}
            @else
            {{-- SI ELIGIO UNA DIRECCION GUARDADA --}}
            <div id="saved-direcciones">
              <div class="row container justify-content-center form">
                
                <div class="col-md-8">
                  <div class="form-group">
                    <h3 class="payment-step-tittle">Utilice una de sus direcciones guardadas</h3>
                    <select id="direccion-select" name="direccion" style="font-family: FontAwesome, sans-serif;">
                      @foreach ($direcciones as $direccion)
                      <option value="{{ $direccion->id }}">
                        {{ $direccion->fulladress }}</option>
                        @endforeach
                      </select>
                      @if ($errors->has('card'))
                      <span class="help-block ">
                        <small class="text-danger">{{ $errors->first('card') }}</small>
                      </span>
                      @endif
                    </div>
                  </div>

                </div>
              </div>
              
              <div id="other_direccion">
                <div class="form">
                  <div class="row">
                    <div class="col-md-12">
                      @if (sizeof($carrito) > 1)
                      <p class="payment-step-paragraph">Por favor llene el siguiente formulario para enviar los productos
                        @foreach ($carrito as $row)
                          @if ($row->options['entregable'] == 1)
                            <strong>{{ $row->name }},</strong>
                          @endif
                        @endforeach
                      .</p>
                      
                      @elseif(sizeof($carrito) == 1)
                      <p class="payment-step-paragraph">Por favor llene el siguiente formulario para enviar el producto
                        @foreach ($carrito as $row)
                          @if ($row->options['entregable'] == 1)
                            <strong>{{ $row->name }}.</strong>
                          @endif
                        @endforeach
                      </p>
                      @endif
                      
                      <div class="form-group">
                        <div class="row m-1">
                          <div class="col-md-4">
                            <label for="">Estado</label>
                            <input id="estado" class="form-control{{ $errors->has('pedido_estado') ? ' is-invalid' : '' }}" type="text" name="pedido_estado" value="{{ old('pedido_estado') }}"/>
                            
                            @if ($errors->has('pedido_estado'))
                            <span class="help-block ">
                              <small class="text-danger">{{ $errors->first('pedido_estado') }}</small>
                            </span>
                            @endif
                            
                          </div>
                          <div class="col-md-4">
                            <label for="">Ciudad</label>
                            <input id="ciudad" class="form-control{{ $errors->has('pedido_ciudad') ? ' is-invalid' : '' }}" type="text" name="pedido_ciudad" value="{{ old('pedido_ciudad') }}"/>
                            
                            @if ($errors->has('pedido_ciudad'))
                            <span class="help-block ">
                              <small class="text-danger">{{ $errors->first('pedido_ciudad') }}</small>
                            </span>
                            @endif
                            
                          </div>
                          <div class="col-md-4">
                            <label for="">Código postal</label>
                            <input id="cp" class="form-control{{ $errors->has('pedido_codigo_postal') ? ' is-invalid' : '' }}" type="text" name="pedido_codigo_postal" value="{{ old('pedido_codigo_postal') }}"/>
                            
                            @if ($errors->has('pedido_codigo_postal'))
                            <span class="help-block ">
                              <small class="text-danger">{{ $errors->first('pedido_codigo_postal') }}</small>
                            </span>
                            @endif
                            
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="row m-1">
                          
                          <div class="col-md-4">
                            <label for="">Colonia</label>
                            <input id="colonia" class="form-control{{ $errors->has('pedido_colonia') ? ' is-invalid' : '' }}" type="text" name="pedido_colonia" value="{{ old('pedido_colonia') }}"/>
                            
                            @if ($errors->has('pedido_colonia'))
                            <span class="help-block ">
                              <small class="text-danger">{{ $errors->first('pedido_colonia') }}</small>
                            </span>
                            @endif
                            
                          </div>
                          <div class="col-md-4">
                            <label for="">Calle</label>
                            <input id="calle" class="form-control{{ $errors->has('pedido_calle') ? ' is-invalid' : '' }}" type="text" name="pedido_calle" value="{{ old('pedido_calle') }}"/>
                            
                            @if ($errors->has('pedido_calle'))
                            <span class="help-block ">
                              <small class="text-danger">{{ $errors->first('pedido_calle') }}</small>
                            </span>
                            @endif
                            
                          </div>
                          <div class="col-md-4">
                            <label for="">Número</label>
                            <input id="numero_direccion" class="form-control{{ $errors->has('pedido_numero') ? ' is-invalid' : '' }}" type="text" name="pedido_numero" value="{{ old('pedido_numero') }}"/>
                            
                            @if ($errors->has('pedido_numero'))
                            <span class="help-block ">
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
                </div>
                
              </div>
              
              @endif
              
              @if (!$direcciones->isEmpty())
                <div class="row text-center mt-3 mb-5">
                  <div class="col-md-12">
                    <button id="btnOcultarDireccion" class="btn-back" type="button" name="button">Otra dirección</button>
                  </div>
                </div>                  
              @endif


              <div class="row float-right mr-1">
                <div class="col-md-12">
                  <a href="{!! route('cart.content') !!}" class="previous btn-back">Anterior</a>
                  <button id="next-button" type="submit" class="next btn-sec">Siguiente</button>
                </div>
              </div>
              
              
            </form>
            
            
            
          </div>
        </div>
        
      </div>
      
    </section>
    
    
    @endsection
    