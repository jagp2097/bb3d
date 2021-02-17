@extends('layouts.app')
@section('content')

@section('scripts')
<script src="{{ asset('js/elementos_w3css.js') }}"></script>
@endsection

@if (session('success_checkout'))
<div class="container alert alert-info" role="alert">
  {{ session('success_checkout') }}
</div>
@endif

@if (session('status'))
<div class="container alert alert-info" role="alert">
  {{ session('status') }}
</div>
@endif

<section id="team" class="wow fadeInDown">
  <div class="container">
    <div class="section-header">
      <h4>Perfil</h4>
    </div>
    
    <div class="row">
      
      <div class="col-lg-3 col-md-6">
        <div class="member">
          <div class="pic"><img src="{{ asset('images/perfil_fotos') }}/{{ $perfil->foto }}" alt="foto de perfil"></div>
          <div class="details">
            <h4>{{ $perfil->fullname}}</h4>
            <span>{{ $perfil->user->email }}</span>
            <h2>Fecha de nacimiento: {{ $perfil->fecha_nacimiento }}</h2>
            <h2>País de origen: {{ $perfil->pais_origen }}</h2>
            <h2>Teléfono: {{ $perfil->telefono }}</h2>
            <h2>Creado: {{ $perfil->created_at->format('d-F-y') }}</h2>
          </div>
        </div>
      </div>
      
      <div class="col-lg-9 col-md-6">
        <section id="services-mod">
          <div class="container">
            <div class="row">
              
              @can('index', bagrap\Archivo::class)
              <div class="col-lg-4">
                <div class="box wow" onclick="window.location='{{ route('archivo.index') }}'" style="cursor:pointer;">
                  <a style="color:#ef597d;" role="button" href="{{ route('archivo.index') }}">
                    <div class="icon"><i class="ion-android-document"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('archivo.index') }}">Mis archivos</a></h4>
                  </a>
                </div>
              </div>                  
              @endcan
              
              @can('create', bagrap\Paquete::class)
              <div class="col-lg-4" onclick="window.location='{{ route('paquete.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('paquete.index') }}">
                    <div class="icon"><i class="ion-cube"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('paquete.index') }}">Productos</a></h4>
                  </a>
                </div>
              </div>                
              @endcan
              
              @can('index', bagrap\Compra::class)
              <div class="col-lg-4" onclick="window.location='{{ route('compra.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('compra.index') }}">
                    <div class="icon"><i class="ion-ios-cart"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('compra.index') }}">Mis compras</a></h4>
                  </a>
                </div>
              </div>                
              @endcan
              
              @can('getCardsClient', Openpay::class)
              <div class="col-lg-4" onclick="window.location='{{ route('openpay.getCards') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('openpay.getCards') }}">
                    <div class="icon"><i class="ion-card"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('openpay.getCards') }}">Mis tarjetas</a></h4>
                  </a>
                </div>
              </div>                  
              @endcan
              
              @can('index', bagrap\Direccion::class)
              <div class="col-lg-4" onclick="window.location='{{ route('direccion.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('openpay.getCards') }}">
                    <div class="icon"><i class="ion-android-home"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('direccion.index') }}">Mis direcciones</a></h4>
                  </a>
                </div>
              </div>                
              @endcan
              
              @can('index', bagrap\Pedido::class)
              <div class="col-lg-4" onclick="window.location='{{ route('pedidos.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('pedidos.index') }}">
                    <div class="icon"><i class="ion-android-document"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('pedidos.index') }}">Pedidos 
                        <label style="font-weight:700; color:red;">{{ bagrap\Pedido::where('entregado', '=', 0)
                            ->where('error', 'completed')->count() }}</label>
                    </a></h4>
                  </a>
                </div>
              </div>               
              @endcan

              @can('index', bagrap\Pedido::class)
              <div class="col-lg-4" onclick="window.location='{{ route('post.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('post.index') }}">
                    <div class="icon"><i class="ion-android-create"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('post.index') }}">Posts</a></h4>
                  </a>
                </div>
              </div>               
              @endcan
              
              {{-- <div class="col-lg-4" onclick="window.location='{{ route('users.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('users.index') }}">
                    <div class="icon"><i class="ion-ios-glasses"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('users.index') }}">Admin</a></h4>
                    {{-                   <p class="description"></p>
                    <p class="description"></p> -}}
                  </a>
                </div>
              </div> --}}
              
              @can('create', bagrap\Ginecologo::class)
              <div class="col-lg-4" onclick="window.location='{{ route('ginecologo.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('ginecologo.index') }}">
                    <div class="icon"><i class="ion-ios-medical"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('ginecologo.index') }}">Ginecólogos</a></h4>
                  </a>
                </div>
              </div>                
              @endcan
              
              @can('index', bagrap\Coupon::class)
              <div class="col-lg-4" onclick="window.location='{{ route('coupon.index') }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('coupon.index') }}">
                    <div class="icon"><i class="ion-pricetags"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('coupon.index') }}">Cupones</a></h4>
                  </a>
                </div>
              </div>                
              @endcan

              @can('index', bagrap\Opinion::class)
              <div class="col-lg-4" onclick="window.location='{{ route('opinion.index') }}'" style="cursor:pointer;">
                  <div class="box wow">
                    <a style="color:#ef597d;" role="button" href="{{ route('opinion.index') }}">
                      <div class="icon"><i class="ion-chatboxes"></i></div>
                      <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('opinion.index') }}">Opiniones
                          <label style="font-weight:700; color:red;">{{ bagrap\Opinion::all()->count() }}</a></h4></label>
                              </a></h4>
                    </a>
                  </div>
                </div>  
              @endcan

                <div class="col-lg-4" onclick="window.location='{{ route('perfil.edit', $perfil->id) }}'" style="cursor:pointer;">
                <div class="box wow">
                  <a style="color:#ef597d;" role="button" href="{{ route('perfil.edit', $perfil->id) }}">
                    <div class="icon"><i class="ion-ios-person"></i></div>
                    <h4 class="title"><a style="color:#ef597d;" role="button" href="{{ route('perfil.edit', $perfil->id) }}">Modifcar perfil</a></h4>
                  </a>
                </div>
              </div>
              
              @if (!(Auth::user()->role_id == 1))
              <div onclick="abrir_modal_eliminar()" class="col-lg-4" style="cursor:pointer;">
                <div class="box wow">
                  {{-- <form action="{{ route('perfil.delete', $perfil->id) }}" method="post">
                    {{ csrf_field() }}
                    @method('DELETE')
                  </form> --}}
                  <button class="btn-del-acc">
                    <div class="icon"><i class="ion-android-close"></i></div>
                    <h4 style="color:#ef597d;" class="title">Eliminar cuenta</h4>
                  </button>
                </div>
              </div>                  
              @endif
              
              <div class="col-lg-4" style="cursor:pointer;">
                <div class="box wow">
                  <form action="{{ route('logout') }}" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="btn-del-acc">
                      <div class="icon"><i class="ion-log-out"></i></div>
                      <h4 style="color:#ef597d;" class="title">Cerrar sesión</h4>
                    </button>
                  </form>
                </div>
              </div>
              
            </div>
          </div>
        </section>
      </div>
      
    </div>
  </div>
</section>

<div id="modal_eliminar_cuenta" class="w3-modal w3-animate-opacity">
  <section id="contact">
    <div class="w3-modal-content w3-card-2">
      <span onclick="cerrar_modal_eliminar()"class="w3-button w3-large w3-display-topright">&times;</span>
      <div class="w3-container w3-padding-large w3-padding-24">
        <div class="section-header">
          <h4>Eliminar cuenta</h4>
        </div>
        
        <div class="row container w3-padding text-center">
          <div class="col-md-12">
            No nos gustaría perderte. ¿Estás seguro de querer eliminar tu cuenta?
          </div>
        </div>
        
        <div class="row container text-center w3-padding-large">
          <div class="col-md-12">
            <a class="btn-del" href="{{ route('opinion.create') }}">Si, eliminar cuenta</a>
            <button onclick="cerrar_modal_eliminar()" class="btn-sec">No, conservar cuenta</button>          
          </div>
        </div>
      </div>
      
    </div>
  </section>  
</div>

@endsection
