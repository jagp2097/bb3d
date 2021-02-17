<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>{{ config('app.name', 'Bb3D') }}</title>
  {{-- <title>Reveal Bootstrap Template</title> --}}
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="Bb3D es un modelo impreso en 3D de tu bebé, que se realiza a partir de un estudio ecográfico." name="description">
  
  @yield('metas-fb')

  <!-- Favicons -->
  <link href="{{ asset('images/pagina/bb3d_logo.ico') }}" rel="icon">
  <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  
  <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
  
  {{-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400" rel="stylesheet"> --}}
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  
  <!-- Bootstrap CSS File -->
  <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- W3.CSS -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <!-- Libraries CSS Files -->
  <link href="{{ asset('lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('lib/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
  {{-- <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet"> --}}
  
  <!-- Main Stylesheet File -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  
  <style>
    #header-sticky-wrapper {
      margin-bottom: 20px;
    }
    
    /*footer#footer {
      margin-top: 40px;
    }*/
  </style>
  
  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
    ======================================================= -->
  </head>
  
  <body id="body">

      <!--==========================
        Header
        ============================-->
        <header id="header">
          <div class="container">
            
            <a href="{{ url('/') }}">
              <img src="{{ asset('images/pagina/bb3d_logo1.png') }}" class="logo_bb3d" alt="Bb3D">
            </a>
            
            {{-- <h1><a href="#body" class="scrollto">Bagr<span>ap</span></a></h1> --}}
            <!-- Uncomment below if you prefer to use an image logo -->
            {{-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a> --}}
            {{-- <div id="logo" class="pull-left"> --}}
              {{-- </div> --}}
              
              <nav id="nav-menu-container">
                <ul class="nav-menu">
                  
                  
                  @guest
                  <li class="menu-active"><a href="{{ url('/') }}">Inicio</a></li>
                  <li class="menu-active"><a href="{{ route('post.list') }}">Posts de Bb3D</a></li>
                  {{-- <li><a href="#about">Nosotros</a></li> --}}
                  {{-- <li><a href="#services">Servicios</a></li> --}}
                  {{-- <li><a href="{{ route('paquete.index') }}">Productos</a></li> --}}
                  {{-- <li><a href="#team">Equipo</a></li> --}}
                  
                  {{-- <li><a href="#contact">Contacto</a></li> --}}
                  <li><a href="{{ route('login') }}">Log in</a></li>
                  {{-- @if(Route::has('register'))
                  {{- <li><a href="{{ route('register') }}">Register</a></li> -}}
                  @endif --}}
                  @else
                  @if(Auth::user()->role_id == 2)
                  <li class="menu-active"><a href="{{ url('/') }}">Inicio</a></li>
                  <li><a href="{{ route('paquete.index') }}">Productos</a></li>                  
                  <li>
                    <a style="margin-left:7px;padding:6px; vertical-align: middle;" href="#">
                      {{ Cart::count() }}<i style="vertical-align: middle; margin-left:5px;font-size:1.3em;" class="ion-ios-cart my-auto"></i>
                    </a>
                  </li>
                  <li><a href="{{ route('post.list') }}">Posts de Bb3D</a></li>
                  @else
                  <li>
                      <a style="margin-left:7px;padding:7px; vertical-align: middle;" href="{{ route('pedidos.index') }}"> 
                          <i style="vertical-align: middle; margin-left:5px;font-size:1.3em;" class="ion-cube my-auto"></i> 
                          {{ bagrap\Pedido::where('entregado', '=', 0)
                          ->where('error', 'completed')->count() }} Pedidos en proceso</a>
                    </li>
                  @endif
                  <li class="menu-has-children"><a href="#">{{ Auth::user()->perfil->nombre }}</a>
                    <ul>
                      <li>
                        <a href="{{ route('perfil.show') }}">Perfil</a>
                      </li>
                      <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                      </li>
                    </ul>
                    
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  </li>
                  @endguest
                </ul>
              </nav><!-- #nav-menu-container -->
            </div>
          </header><!-- #header -->
          
          
          <main id="main">
            <div class="container">
              @yield('content')
            </div>
            
            
          </main>
          
          <!--==========================
            Footer
            ============================-->
            <footer>
              <div class="container">
                <div class="row">
                  
                  <div class="col-md-6">
                    <ul class="footer-nav">
                      <li> <a href="https://www.google.com/maps?ll=25.685433,-100.345914&z=16&t=m&hl=en-US&gl=MX&mapclient=embed&q=Mitras+Sur+64020+Monterrey,+Nuevo+Leon"><i class="ion-ios-location"></i> Guadalajara 910, Mitras Sur, Monterrey, Nuevo León C.P: 64020</a></li>
                      <li> <a href="mailto:contacto@bb3d.mx"><i class="ion-ios-email"></i> contacto@bb3d.mx</a></li>
                      <li> <a href="tel:+52018127213864"><i class="ion-ios-telephone"></i> +52 01 81 2721 3864</a></li>
                    </ul>
                  </div>
                  
                  {{-- <div class="col-md-4"> --}}
                    {{-- <ul class="legal-links"> --}}
                      {{-- <li><a href="{{ route('legal.aviso') }}">Aviso de privacidad</a></li> --}}
                      {{-- <li><a href="{{ route('legal.terminos') }}">Terminos y condiciones</a></li> --}}
                    {{-- </ul> --}}
                  {{-- </div> --}}
                  
                  <div class="col-md-6">
                    <ul class="social-links">
                      <li><a href="https://www.facebook.com/bebe3dmx/" target="_blank"><ion-icon class="facebook" name="logo-facebook"></ion-icon>bebe3dmx/</a></li>
                      <li><a href="https://www.instagram.com/bb3d_mx/" target="_blank"><ion-icon class="instagram" name="logo-instagram"></ion-icon>bb3d_mx/</a></li>
                    </ul>
                  </div>
                  
                </div>
                
                <div class="row justify-content-center">
                  <div class="col-md-12">
                      <p><a href="{{ route('legal.aviso') }}">Aviso de privacidad</a></p>
                      <p><a href="{{ route('legal.terminos') }}">Terminos y condiciones</a></p>
                      <p>Copyright 2019 by <a href="https://masterdeploy.mx/" target="_blank">Master Deploy &copy;</a>. All rights reserved.</p>
                      {{-- <p>Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a></p> --}}
                  </div>
                </div>
                
              </div>
              
            </footer>
            <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
            -->
            
            
            {{-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> --}}
            
            <!-- JavaScript Libraries -->
            <script src="{{ asset('lib/jquery/jquery-migrate.min.js') }}"></script>
            <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
            <script src="{{ asset('lib/superfish/hoverIntent.js') }}"></script>
            <script src="{{ asset('lib/superfish/superfish.min.js') }}"></script>
            <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
            <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
            <script src="{{ asset('lib/magnific-popup/magnific-popup.min.js') }}"></script>
            <script src="{{ asset('lib/sticky/sticky.js') }}"></script>
            <script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
            <script src="{{ asset('lib/jQuery-Mask/jquery.mask.min.js') }}"></script>
            
            
            <!-- Contact Form JavaScript File -->
            {{-- <script src="{{ asset('contactform/contactform.js') }}"></script> --}}
            @yield('scripts')
            
            <!-- Template Main Javascript File -->
            <script src="{{ asset('js/main.js') }}"></script>
            
          </body>
          </html>
          