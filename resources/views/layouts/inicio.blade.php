<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="" name="keywords">
	<meta content="" name="description">

	<!-- Favicons -->
    <link href="//{{ asset('images/pagina/bb3d_logo.ico') }}" rel="icon">
	<link href="img/apple-touch-icon.png" rel="apple-touch-icon">

    <title>{{ config('app.name', 'Bb3D') }}</title>
    
    <link rel="stylesheet" href="//{{ asset('lib/normalize/normalize.css') }}">
    <link rel="stylesheet" href="//{{ asset('lib/gridsystem/grid.css') }}">
    <link rel="stylesheet" href="//{{ asset('css/styleshome.css') }}">
    
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">
    
    
</head>
<body>
    
    <header id="header-guest">
        <nav id="nav">
            <a id="logo-link" href="{{ url('/') }}">
                <img src="//{{ asset('images/pagina/bb3d_logo1.png') }}" class="logo_bb3d" alt="Bb3D logo">
            </a>
            <div class="row">
                <ul class="main-nav">
                    @guest
                    <li class="menu-active"><a href="#header-guest">Inicio</a></li>
                    <li><a href="#info-bb3d">¿Qué es un Bb3D?</a></li>
                    <li><a href="#productos">Productos</a></li>
                    <li><a href="#obtener">Obtener tu Bb3D</a></li>
                    <li><a href="{{ route('login') }}">Log in</a></li>
                    {{-- @if(Route::has('register'))
                    {{- <li><a href="{{ route('register') }}">Register</a></li> -}}
                    @endif --}}
                    @else
                    @if(Auth::user()->role_id == 2)
                    <li class="menu-active"><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ route('paquete.index') }}">Productos</a></li>                  
                    <li>
                        <a style="margin-left:7px;padding:6px; vertical-align: middle;" href="{{ route('cart.content') }}">
                            {{ Cart::count() }}<i style="vertical-align: middle; margin-left:5px;font-size:1.3em;" class="ion-ios-cart my-auto"></i>
                        </a>
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
                {{-- <a class="mobile-nav-icon" href="#"><i class="fa fa-bars"></i></a> --}}
            </div>
        </nav>
        <div class="header-textbox">
            <h1 class="header-text">Le damos forma a tus recuerdos</h1>
            <a href="#" class="btn-bb3d-info scrollInfo">Conoce más de Bb3D</a>
            @if(!Auth::check())
            <a href="{{ route('register') }}" class="btn-bb3d-reg">Crea una cuenta</a>
            @endif
        </div>
    </header>
    
    {{-- INICIO SECCIÓN DE LA INFORMACÓN DE BB3D --}}
    <section class="info-bb3d" id="info-bb3d">
        <div class="row">
            <h2 class="section-title">Bb3D &mdash; ¿Qué es?</h2>
            <p class="section-paragraph">Un Bb3d es un modelo tridimensional de tu bebé, el cual es generado tomando como base la infloración de un estudio ecográfico para después generar una impresión 3D.</p>
        </div>
        
        <div class="row">
            <div class="col span-1-of-3">
                <p class="icon-section"><i class="fa fa-grip-horizontal"></i></p>
                <h3 class="section-subtitle">Decoración</h3>
                <p class="section-paragraph-subtitle">Utiliza tu BB3D como un árticulo decorativo muy diferente a lo común.</p>
            </div>
            <div class="col span-1-of-3">
                <p class="icon-section"><i class="fa fa-heart-o"></i></p>
                <h3 class="section-subtitle">Recuerdo</h3>
                <p class="section-paragraph-subtitle">Preserva el recuerdo único de la primera vez en que conociste a tu bebé.</p>
            </div>
            <div class="col span-1-of-3">
                <p class="icon-section"><i class="fa fa-gift"></i></p>
                <h3 class="section-subtitle">Regalo</h3>
                <p class="section-paragraph-subtitle">Sorprende a una persona especial con un Bb3D.</p>
            </div>
        </div>
        
    </section>
    {{-- FIN SECCION DE LA INFORMACIÓN DE BB3D --}}
    
    {{-- INICIO SECTION PRODUCTOS POPULARES --}}
    <section id="productos" class="products-bb3d">
        <div class="row">
            <h2 class="section-title">Nuestros productos</h2>
            <p class="section-paragraph">Estos son algunos de los productos que más prefieren nuestros clientes.</p>
        </div>
        
        <div class="row">
            <div class="col span-1-of-3">
                <div class="box">
                    <img src="//{{ asset('images/pagina/prueba.jpeg') }}" alt="">
                    <p class="product-price">$1,199.00 <small>c/u</small></p>
                    <h3 class="product-title">Bb3d - Medida 4 cm x 6 cm</h3>
                    <p class="product-paragraph">Bb3d hecho con material acrílico y con cuadro incluido</p>
                </div>
            </div>
            <div class="col span-1-of-3">
                <div class="box">
                    <img src="//{{ asset('images/pagina/prueba.jpeg') }}" alt="">
                    <p class="product-price">$1,349.00 <small>c/u</small></p>
                    <h3 class="product-title">Bb3D - Medida 6 cm x 8 cm</h3>
                    <p class="product-paragraph">Bb3d hecho con material acrílico con cuadro incluido</p>
                </div>
            </div>
            <div class="col span-1-of-3">
                <div class="box">
                    <img src="//{{ asset('images/pagina/prueba.jpeg') }}" alt="">
                    <p class="product-price">$1,499.00 <small>c/u</small></p>
                    <h3 class="product-title">Bb3D - Medida 8 cm x 10 cm</h3>
                    <p class="product-paragraph">Bb3d hecho con material acrílico y con cuadro incluido</p>
                </div>
            </div>
        </div>
    </section>
    {{-- FIN SECTION PRODUCTOS POPULARES --}}
    
    {{-- INICIO PASOS COMPRAR --}}
    <section id="obtener" class="steps-bb3d">
        <div class="row">
            <h2 class="section-title">¿Cómo obtener tu BB3D?</h2>
        </div>
        <div class="row">
            <div class="col span-1-of-8"></div>
            <div class="col span-6-of-8">
                <video class="video-steps" controls>
                    <source src="//{{ asset('images/pagina/video-steps.mp4') }}" type="video/mp4">
                    </video>
                </div>
                <div class="col span-1-of-8"></div>
            </div>
        </section>
        {{-- FIN PASOS COMPRAR --}}
        
        <!--==========================
            Footer
            ============================-->
            <footer>
                <div>
                    
                    <div class="row justify-content-center">
                        <p>Proyecto Bb3D demo</p>
                        <p>Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a></p>
                    </div>
                    
                </div>
                
            </footer>
            <!--
                All the links in the footer should remain intact.
                You can delete the links only if you purchased the pro version.
                Licensing information: https://bootstrapmade.com/license/
                Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Reveal
            -->
            
            <!-- JavaScript Libraries -->
            <script src="lib/jquery/jquery.min.js"></script>
            <script src="lib/jquery/jquery-migrate.min.js"></script>
            <script src="lib/easing/easing.min.js"></script>
            <script src="lib/superfish/hoverIntent.js"></script>
            <script src="lib/superfish/superfish.min.js"></script>
            <script src="lib/waypoint/jquery.waypoints.min.js"></script>    
            {{-- FontAwesome --}}
            <script src="https://kit.fontawesome.com/7ea333a476.js"></script>   
            <script src="https://unpkg.com/ionicons@4.5.0/dist/ionicons.js"></script>
            <script src="js/bb3d-home.js"></script>
            
        </body>
        </html>