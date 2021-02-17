@extends('layouts.app')
@section('scripts')
<script src="{{ asset('js/elementos_w3css.js') }}"></script>

<script>
  $('#album-edit').on('click', function(event) {
    $('#modal-form').submit();
    location.href;
  });
  
  if (!('{{ $errors->isEmpty() }}')) {
    console.log('Hay errores');
    $('.popup-form').magnificPopup({
      type: 'inline'
    }).magnificPopup('open');
  }
  
  var imgRef = document.getElementsByClassName('popup-img');
  
  Array.from(imgRef).forEach(function(element) {
    element.addEventListener('click', function() {

      $('.portfolio-popup').magnificPopup({
        items: {
          type: 'image',
          src: element.src,
        },
      }).magnificPopup('open');
      
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
              <h4>Álbum: {{ $album->nombre_album}}</h4>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 text-right">
              <div class="row">
                <div class="col-lg-12 justify-content-center">
                  <a href="{{ route('archivo.index') }}" class="btn-back" role="button"> Regresar </a>
                  @can ('update', $album)
                  <button href="#album_edit" class="btn-edit popup-form">Editar álbum</button>
                  @endcan
                  @can ('delete', $album)
                  <button onclick="abrir_modal_eliminar_album()" class="btn-del" type="button" name="button">Eliminar álbum</button>                  
                  @endcan
                </div>
              </div>
            </div>
            
            <section id="contact">
              <div id="album_edit" class="form white-popup mfp-hide container">
                <h5>Nuevo álbum</h5>
                <form id="modal-form" class="" action="{{ route('album.update', $album->id) }}" method="post">
                  @method('PATCH')
                  {{ csrf_field() }}
                  <div class="form-row col-md-12">
                    <label for="">Nombre del álbum</label>
                    <input class="form-control{{ $errors->has('nombre_album') ? ' is-invalid' : '' }}" type="text" name="nombre_album" value="{{ $album->nombre_album }}"/>
                    @if ($errors->has('nombre_album'))
                    <span class="invalid-feedback" role="alert">
                      <small class="text-danger">{{ $errors->first('nombre_album') }}</small>
                    </span>
                    @endif
                  </div>
                  <div class="form-row col-md-12">
                    <label for="">Descripción álbum</label>
                    <input class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" type="text" name="descripcion" value="{{ $album->descripcion }}"/>
                    @if ($errors->has('descripcion'))
                    <span class="invalid-feedback" role="alert">
                      <small class="text-danger">{{ $errors->first('descripcion') }}</small>
                    </span>
                    @endif
                  </div>
                  
                  <div class="row container text-center">
                    <div class="col-md-12 mt-2 p-1 ml-2">
                      <button id="album-edit" type="submit" class="btn-sm btn-mod-alb portfolio-popup-modal">Editar</button>
                    </div>
                  </div>
                </form>
              </div>
            </section>
          </div>
          
          <section id="portfolio-mod">
            <div class="container">
              <div class="row">
                @foreach ($album->archivos as $archivo)
                <div class="col-lg-1 col-md-3 col-sm-4">
                  <div class="portfolio-item wow">
                    @if (strpos($archivo->referencia, '.vol'))
                    <a id="popup-button" href="#{{ $archivo->id }}" class="portfolio-popup-modal">
                      <img src="{{ asset('images/pagina/vol-file-icon.png') }}">
                      {{-- <div class="portfolio-overlay">
                      </div> --}}
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
                            <form action="{{ route('archivo.move') }}" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="archivo_id" value="{{ $archivo->id }}">
                              <select class="select-mod" name="album">
                                <option value="sin_album">Sacar del álbum</option>
                                @foreach ($albumes as $album)
                                <option value="{{ $album->id }}">{{ $album->nombre_album }}</option>
                                @endforeach
                              </select>
                              <button class="btn-sec" type="submit" name="button">Mover</button>
                            </form>
                            <div class="row container">
{{--                               @can ('show', $archivo)
                              <form class="mt-2 p-1" action="{{ route('stl.model', $archivo->referencia) }}">
                                <button type="submit" class="btn btn-sm btn-mod-ver">Ver</button>
                              </form>
                              @endcan --}}
                              @can ('download', $archivo)
                              <form class="mt-2 p-1" action="{{ route('archivo.download', $archivo->id) }}">
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
                    
                    @else
                    <a id="popup-button" href="#{{ $archivo->id }}" class="portfolio-popup-modal-arch">
                      <img src="{{ asset('images/archivos_cliente') }}/{{ $archivo->referencia }}">
                      {{-- <div class="portfolio-overlay">
                      </div> --}}
                    </a>
                    
                    {{-- Modal magnific --}}
                    <section id="services-mod">
                      <div id="{{ $archivo->id }}" class="white-popup mfp-hide container">
                        <div class="row">
                          <div class="col-lg-4 col-md-6 pic-modal justify-content-center align-middle">
                            <img style="cursor:pointer;" class="popup-img" src='{{ asset('images/archivos_cliente') }}/{{ $archivo->referencia }}'>
                            <small>Clic en la imagen para agrandar</small>
                            <a href="#" data-img='{{ asset('images/archivos_cliente') }}/{{ $archivo->referencia }}' class="portfolio-popup">
                            </a>
                          </div>
                          <div class="col-lg-8 col-md-6 justify-content-center">
                            <p class="description-mod">Archivo: {{ $archivo->nombre_archivo }}</p>
                            <form action="{{ route('archivo.move') }}" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="archivo_id" value="{{ $archivo->id }}">
                              <select class="select-mod" name="album">
                                <option value="sin_album">Sacar del álbum</option>
                                @foreach ($albumes as $album)
                                <option value="{{ $album->id }}">{{ $album->nombre_album }}</option>
                                @endforeach
                              </select>
                              <button class="btn-sec" type="submit" name="button">Mover</button>
                            </form>
                            <div class="row container ">
                              @can ('download', $archivo)
                              <form class="mt-2 p-1" action="{{ route('archivo.download', $archivo->id) }}">
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
                @endforeach
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>

  <div id="modal_eliminar_album" class="w3-modal w3-animate-opacity">
    <section id="contact">
      <div class="w3-modal-content w3-card-2">
        <span onclick="cerrar_modal_eliminar_album()" class="w3-button w3-large w3-display-topright">&times;</span>
        <div class="w3-container w3-padding-large w3-padding-24">
          <div class="section-header">
            <h4>Eliminar álbum</h4>
          </div>

          <div class="row container w3-padding justify-content-center">
            <div class="col-md-9 text-center">
              ¿Estás seguro de querer eliminar el álbum <strong>{{ $album->nombre_album }}</strong>? Todos los archivos que estan almacenados en este álbum se perderán.
            </div>
          </div>

          <div class="row container text-center w3-padding-large">
            <div class="col-md-12">
              <form style="display: inline;" action="{{ route('album.destroy', $album->id) }}" method="post">
                {{ csrf_field() }}
                @method('DELETE')
              <button type="submit" class="btn-del">Si, eliminar álbum</button>
              <button type="button" onclick="cerrar_modal_eliminar_album()" class="btn-sec">No, conservar álbum</button>          
              </form>
            </div>
          </div>
        </div>

      </div>



    </section>  
  </div>


  @endsection
  