@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/elementos_w3css.js') }}"></script>

<script>
  //Subir la información del modal (crear, editar)
  $('#album-create').on('click', function(event) {
    $('#album-create').prop('disabled', true);

    $('#modal-form').submit();
    location.href;
  });

  $('#archivo-create').on('click', function(event) {
    $('#modal-form-acrch-create').submit();
    location.href;
  });
  
  if(!('{{ $errors->errorsArchivos->isEmpty() }}')) {
    // console.log('No hay errores');
    $('.portfolio-popup-modal-arch').magnificPopup({
      type: 'inline'
    }).magnificPopup('open');
  }

  if(!('{{ $errors->errorsAlbumes->isEmpty() }}')) {
    // console.log('No hay errores');
    $('.popup-form').magnificPopup({
      type: 'inline'
    }).magnificPopup('open');
  }
  
  var imgRef = document.getElementsByClassName('popup-img');
  var btnBorrarArchivo = document.getElementsByClassName("borrar-arch");
  
  Array.from(imgRef).forEach(function(element) {
    element.addEventListener('click', function() {

      $('.portfolio-popup').magnificPopup({
        items: {
          src: element.src,
          type: 'image'
        }
      }).magnificPopup('open');
    });
  });

  Array.from(btnBorrarArchivo).forEach(function(element) {
    element.addEventListener('click', function() {

      $('.portfolio-popup').magnificPopup({
        items: {
          src: element.src,
          type: 'image'
        }
      }).magnificPopup('close');

    });
  });
  
</script>
@endsection
@section('content')

<section id="clients">
  <div class="container">
    <div class="row">
      
      <div class="col-lg-12 justify-content-center">
        <div class="section-header">
          
          <div class="row">
            
            <div class="col-sm-6 col-md-6 col-lg-6">
              <h4>Mis archivos </h4>
            </div>
            
            <div class="col-sm-6 col-md-6 col-lg-6 text-right">
              <div class="row">
                <div class="col-lg-12 justify-content-center">
                  <a href="{{ route('perfil.show') }}" class="btn-sec" role="button"> Perfil </a>
                  <a href="#archivo_create" class="btn-back portfolio-popup-modal-arch">Añadir archivo</a>
                  @can ('create', bagrap\Album::class)
                  <a href="#album_create" class="btn-edit popup-form">Crear álbum</a>
                  @endcan
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      
      <div class="col-lg-6 justify-content-center box">
        <div class="section-header text-center">
          <h5>Archivos</h5>
        </div>
        
        <section id="portfolio-mod">
          <div class="container">
            <div class="row">
              @foreach ($archivos as $archivo)
                @if($archivo->album_id == null)
                <div class="col-lg-3 col-md-2 col-sm-2">
                    <div class="portfolio-item wow">
                      @if(strpos($archivo->referencia, '.vol'))
                      <a id="popup-button" href="#{{ $archivo->id }}" class="portfolio-popup-modal">
                        <img src="{{ asset('images/pagina/vol-file-icon.png') }}">
                      </a>

                      {{-- Modal magnific --}}
                      <section id="services-mod">
                        <div id="{{ $archivo->id }}" class="white-popup mfp-hide container">
                          <div class="row">
                            <div class="col-lg-4 col-md-6 pic-modal justify-content-center">
                              <img class="mod-log" src="{{ asset('images/pagina/vol-file-icon.png') }}">
                            </div>
                            <div class="col-lg-8 col-md-6 justify-content-center">
                              <p class="description-mod">Archivo: {{ $archivo->nombre_archivo }}</p>
                              @if ($albumes->isNotEmpty())
                              <form action="{{ route('archivo.move') }}" method="post">
                              {{ csrf_field() }}
                                <input type="hidden" name="archivo_id" value="{{ $archivo->id }}">
                                <select class="select-mod" name="album">
                                @foreach ($albumes as $album)
                                  <option value="{{ $album->id }}">{{ $album->nombre_album }}</option>
                                @endforeach
                                </select>
                                <button class="btn-sec" type="submit" name="button">Mover</button>
                              </form>
                              @endif
                              <div class="row container">
                              {{-- @can ('show', $archivo)
                                <form class="mt-2 p-1" action="{{ route('stl.model', $archivo->referencia) }}">
                                  <button type="submit" class="btn-mod-ver">Ver</button>
                                </form>
                              @endcan --}}
                                @can ('download', $archivo)
                                <form class="mt-2 p-1" action="{{ route('archivo.download', $archivo->id) }}" method="GET">
                                @csrf
                                  <button class="btn-edit" type="submit">Descargar</button>
                                  @can ('delete', $archivo)
                                  <button class="btn-del borrar-arch"type="button" onclick="abrir_modal_eliminar_archivo('{{ route('archivo.destroy', $archivo->id) }}', '{{ $archivo->nombre_archivo }}')">Eliminar</button>
                                  @endcan
                                </form>
                                @endcan
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                      {{-- Close - Modal magnific --}}

                      @elseif(strpos($archivo->referencia, '.jpg'))
                      <a id="popup-button" href="#{{ $archivo->id }}" class="portfolio-popup-modal">
                        <img src="{{ asset('images/archivos_cliente') }}/{{ $archivo->referencia }}">
                      </a>

                      {{-- Modal magnific --}}
                      <?php TODO:// Arreglar el magnific popup para las imagens ?>
                      <section id="services-mod">
                        <div id="{{ $archivo->id }}" class="white-popup mfp-hide container">
                          <div class="row">
                            <div class="col-lg-4 col-md-6 pic-modal justify-content-center">
                              <a href="#" data-img='{{ asset('images/archivos_cliente') }}/{{ $archivo->referencia }}' class="portfolio-popup">
                                <img style="cursor:pointer;" class="popup-img" src="{{ asset('images/archivos_cliente') }}/{{ $archivo->referencia }}">
                              </a>
                              <?php // TODO: Modal agrandar foto ?>
                              <small>Clic en la imagen para agrandar</small>
                            </div>
                            <div class="col-lg-8 col-md-6 justify-content-center">
                              <p class="description-mod">Archivo: {{ $archivo->nombre_archivo }}</p>
                              <form action="{{ route('archivo.move') }}" method="post">
                              {{ csrf_field() }}
                                <input type="hidden" name="archivo_id" value="{{ $archivo->id }}">
                                <select class="select-mod" name="album">
                                @foreach ($albumes as $album)
                                  <option value="{{ $album->id }}">{{ $album->nombre_album }}</option>
                                @endforeach
                                </select>
                                <button class="btn-sec" type="submit" name="button">Mover</button>
                              </form>
                              <div class="row container ">
                                @can ('download', $archivo)
                                <form class="mt-2 p-1" action="{{ route('archivo.download', $archivo->id) }}" method="post">
                                {{ csrf_field() }}
                                  <button class="btn-edit" type="submit">Descargar</button>
                                </form>
                                @endcan
                                @can ('delete', $archivo)
                                <form class="mt-2 p-1" action="{{ route('archivo.destroy', $archivo->id) }}" method="post">
                                {{ csrf_field() }}
                                @method('DELETE')
                                  <button class="btn-del" type="submit" name="button">Eliminar</button>
                                </form>
                                @endcan
                              </div>
                            </div>
                          </div>
                      </div>
                    </section>
                    {{-- Close - Modal magnific --}}

                    @endif
                  </div>
                </div>
                @endif
              @endforeach
            </div>
          </div>
        </section>
      </div>
      
      <div class="col-lg-6 justify-content-center box">
        <div class="section-header text-center">
          <h5>Álbumes</h5>
        </div>
        
        <section id="services-mod">
          <div class="container">
            <div class="row">
              @foreach ($albumes as $album)
              <div class="col-lg-6 justify-content-center" style="cursor:pointer;" onclick="window.location='{{route('album.show',$album->id)}}'">
                <div class="box wow">
                  <a role="button" href="{{route('album.show',$album->id)}}">
                    <div class="icon"><i class="ion-ios-albums"></i></div>
                    <h4 class="title"><a role="button">{{$album->nombre_album}}</a></h4>
                    <p class="descripcion">{{ $album->descripcion }}</p>
                    <p class="description">Archivos: {{ $album->archivos->count() }}</p>
                  </a>
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

{{-- Modal crear album --}}
@can ('create', bagrap\Album::class)
<section id="contact">
  <div id="album_create" class="form white-popup mfp-hide container">
    <h5>Nuevo álbum</h5>
    <form id="modal-form" action="{{ route('album.store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-row col-md-12">
        <label for="">Nombre del álbum</label>
        <input class="form-control{{ $errors->errorsAlbumes->has('nombre_album') ? ' is-invalid' : '' }}" type="text" name="nombre_album" value="{{ old('nombre_album') }}"/>
        @if ($errors->errorsAlbumes->has('nombre_album'))
        <span class="invalid-feedback" role="alert">
          <small class="text-danger">{{ $errors->errorsAlbumes->first('nombre_album') }}</small>
        </span>
        @endif
      </div>
      <div class="form-row col-md-12">
        <label for="">Descripción álbum</label>
        <input class="form-control{{ $errors->errorsAlbumes->has('descripcion') ? ' is-invalid' : '' }}" type="text" name="descripcion" value="{{ old('descripcion') }}"/>
        @if ($errors->errorsAlbumes->has('descripcion'))
        <span class="invalid-feedback" role="alert">
          <small class="text-danger">{{ $errors->errorsAlbumes->first('descripcion') }}</small>
        </span>
        @endif
      </div>
      
      <div class="row container text-center">
        <div class="col-md-12 mt-2 p-1 ml-2">
          <button id="album-create" type="button" class="btn-sec">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</section>
@endcan

<section id="contact">
  <div id="archivo_create" class="form white-popup mfp-hide container">
    <h5>Añadir archivo</h5>
    <form id="modal-form-acrch-create" action="{{ route('archivo.store') }}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="form-row col-md-12">
        <label for="">Nombre del archivo</label>
        <input class="form-control{{ $errors->errorsArchivos->has('nombre_archivo') ? ' is-invalid' : '' }}" type="text" name="nombre_archivo" value="{{ old('nombre_archivo') }}"/>
        @if ($errors->errorsArchivos->has('nombre_archivo'))
        <span class="invalid-feedback" role="alert">
          <small class="text-danger">{{ $errors->errorsArchivos->first('nombre_archivo') }}</small>
        </span>
        @endif
      </div>  
      <div class="form-row col-md-12">
        <input type="file" name="archivo" id="archivo" accept=".vol, .jpg"/>
        @if ($errors->errorsArchivos->has('archivo'))
        <span class="help-block" role="alert">
          <small class="text-danger">{{ $errors->errorsArchivos->first('archivo') }}</small>
        </span>
        @endif
      </div>      
      <div class="row container text-center">
        <div class="col-md-12 mt-2 p-1 ml-2">
          <button id="archivo_create" type="submit" class="btn-sec">Guardar</button>
        </div>
      </div>
    </form>
  </div>
</section>


<div id="modal_eliminar_archivo" class="w3-modal w3-animate-opacity">
  <section id="contact">
    <div class="w3-modal-content w3-card-2">
      <span onclick="cerrar_modal_eliminar_archivo()" class="w3-button w3-large w3-display-topright">&times;</span>
      <div class="w3-container w3-padding-large w3-padding-24">
        <div class="section-header">
          <h4>Eliminar archivo</h4>
        </div>

        <div class="row container w3-padding justify-content-center">
          <div id="text_modal" class="col-md-9 text-center">

          </div>
        </div>

        <div class="row container text-center w3-padding-large">
          <div class="col-md-12">
            <form id="form-borrar" class="mt-2 p-1" method="post">
              {{ csrf_field() }}
              @method('DELETE')
              <button type="submit" class="btn-del">Si, eliminar archivo</button>
              <button type="button" onclick="cerrar_modal_eliminar_archivo()" class="btn-sec">No, conservar archivo</button>          
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>  
</div>

@endsection
