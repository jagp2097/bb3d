@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/elementos-confirmar.js') }}"></script>

<script>
  $(document).ready(function() {
    
    document.getElementsByTagName("body").onbeforeunload = function() { 
      return alert("Your work will be lost.");  
    };



    // window.onload = function(){
    //   window.location.hash = "no-back-button";
    //   window.location.hash = "Again-No-back-button"

    //   window.onhashchange = function(){
    //     window.location.hash = "no-back-button";
    //   }
    // }

    $('#btn-completar').on('click', function(event) {
        event.preventDefault();
        
        $('#btn-completar').prop('disabled', true);
        $('#completar-form').submit();

      });
  });

</script>

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
    <h4 class="ml-5">Cargar archivo</h4>
  </div>

  <div class="row justify-content-center mt-5 mb-4">
    <div class="col-lg-3 col-md-3 col-sm-3 text-center">
      <i class="fa fa-file payment-step-icon"></i>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8">
      <p class="payment-step-paragraph">Se ha realizado el cargo a tu tarjeta con éxito. Elige un archivo <strong>(archivo .vol)</strong> para crear tu Bb3d, puedes elegir uno de tus archivos guardados o cargar un archivo nuevo (se guardará en tus archivos).</p> 
    </div>
  </div>
  
  <section id="clients">
    <div class="row justify-content-center">
      
      <div class="col-md-11">
        <div class="form">
          <form id="completar-form" action="{{ route('pago.archivo-post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="table-responsive">
              <table class="table table-bb">
                <thead class="text-center">
                  <th class="p-0" style="width:15%;"></th>
                  <th class="align-middle text-center p-0" scope="col"></th>
                  @if(!$archivos->isEmpty())
                  <th class="align-middle text-center p-0" scope="col"></th>
                  @endif
                  <th class="align-middle text-center p-0" scope="col"></th>
                  @if(!$archivos->isEmpty())
                  <th class="align-middle text-center p-0" scope="col"></th>
                  @endif
                </thead>
                <tbody>
                  @foreach ($carrito as $row)
                  <tr>    
                    <td class="align-middle text-center">
                      <img src="{!! asset('images/productos') !!}/{{ $row->options['imagen_paquete'] }}" alt="">
                    </td>
                    <td class="align-middle text-center">{{ $row->name }}</td>
                    @if(!$archivos->isEmpty())
                    <td class="align-middle text-center">
                    <select class="archivo-select" name="archivo[{{$loop->index}}]">
                        @foreach ($archivos as $archivo)
                        <option value="{{ $archivo->id }}">
                          {{ $archivo->nombre_archivo }}
                        </option>
                        @endforeach
                      </select>
                    </td>
                    @endif
                    <td class="align-middle center">
                      <input type="file" class="form-control-file archivo-input" name="archivo[{{$loop->index}}]" @if(!$archivos->isEmpty()) disabled @endif accept=".vol, .jpg">
                    </td>
                    @if(!$archivos->isEmpty())
                    <td class="align-middle text-center">
                      <button class="btn-edit btn-toggle" type="button" name="button">Cargar uno nuevo</button>
                    </td>
                    @endif
                  </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
            
            <div class="row float-right mr-1">
              <div class="col-md-12">
                <button id="btn-completar" type="button" class="next btn-sec">Completar pedido</button>
              </div>
            </div>
            
            
          </form>
          
          
          
        </div>
      </div>
      
    </div>
  </section>
  
</section>


@endsection
