@extends('layouts.app')
@section('content')
@section('scripts')
<script src="{{ asset('js/elementos_w3css.js') }}"></script>
@endsection

<section id="clients">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 justify-content-center">
        <div class="section-header">
          <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-6">
              <h4>Mis direcciones guardadas</h4>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-right">
              <div class="row">
                <div class="col-lg-12 justify-content-center">
                  <div class="col-lg-12 justify-content-center">
                    <a href="{{ route('perfil.show') }}" class="btn-sec" role="button"> Perfil </a>
                    @can('create', bagrap\Direccion::class)
                    <a role="button" href="{{ route('direccion.create') }}" class="btn-edit">Añadir dirección</a>
                    @endcan
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        
        <section id="services-mod">
          <div class="container">
            <div class="row">
              @foreach ($direcciones as $direccion)
              <div class="col-lg-6 justify-content-center">
                <div class="box">
                  <div class="row">
                    <div class="col-lg-3">
                      <div class="card-icon mt-4 mb-1 text-center">
                        <i class="ion-android-home icon-card my-auto"></i>
                      </div>
                    </div>
                    
                    <div class="col-lg-9">
                      <div class="card-info">
                        <p class="description"><span>Dirección:</span></p>
                        <p class="description">{{ $direccion->fulladress }}</p>
                        @if($direccion->referencias != null)
                          <p class="description"><span>Referencias del lugar:</span> {{ $direccion->referencias }}</p>
                        @endif
                      </div>
                      @can('delete', bagrap\Direccion::class)
                      <button onclick="abrir_modal_eliminar_direccion('{{ route('direccion.destroy', $direccion->id) }}')" class="btn-del mt-3 float-right" type="submit">Eliminar dirección</button>
                      @endcan
                      @can('update', bagrap\Direccion::class)
                      <a href="{{ route('direccion.edit', $direccion->id) }}" class="btn-sec mt-3 float-right">Editar dirección</a>
                      @endcan
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</section>

<div id="modal_eliminar_direccion" class="w3-modal w3-animate-opacity">
  <section id="contact">
    <div class="w3-modal-content w3-card-2">
      <span onclick="cerrar_modal_eliminar_direccion()" class="w3-button w3-large w3-display-topright">&times;</span>
      <div class="w3-container w3-padding-large w3-padding-24">
        <div class="section-header">
          <h4>Eliminar direccion</h4>
        </div>

        <div class="row container w3-padding justify-content-center">
          <div id="text_modal" class="col-md-9 text-center">

          </div>
        </div>

        <div class="row container text-center w3-padding-large">
          <div class="col-md-12">
            <form id="form-borrar-direccion" class="mt-2 p-1" method="post">
              {{ csrf_field() }}
              @method('DELETE')
              <button type="submit" class="btn-del">Si, eliminar direccion</button>
              <button type="button" onclick="cerrar_modal_eliminar_direccion()" class="btn-sec">No, conservar dirección</button>          
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>  
</div>  
@endsection