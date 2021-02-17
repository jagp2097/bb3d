@extends('layouts.app')

@section('scripts')
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);
    
        t._e = [];
        t.ready = function(f) {
        t._e.push(f);
        };
    
        return t;
        }(document, "script", "twitter-wjs"));
    </script>
@endsection

@section('metas-fb')
    <meta property="og:url"                content="{{ URL::current() }}" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="{{ $post->post_title }}" />
    <meta property="og:description"        content="{{ $post->post_description }}" />
    <meta property="og:image"              content="{{ $post->post_thumbnail }}" />    
@endsection

@section('content')

    <article id="post-article" class="row">
        <div class="col-md-9">
            
            <div style="margin: 0; height:60vh; background: url(' {{ asset('images/posts_thumbnails') }}/{{ $post->post_thumbnail }}') no-repeat; background-position: center;">
            </div>

            <div class="entry-header">
                <h1 class="post-entry-title">{{ $post->post_title }}</h1>
                @can('index', bagrap\Pedido::class)
                <div class="text-right">
                    <a class="btn-sec" href="{{ route('post.index') }}">Ir a los posts</a>
                </div>
                @endcan
            </div>

            <div class="entry-info">
                <p><i class="ion-calendar"></i> {{ $post->created_at->diffForHumans() }}</p>
                <p><i class="ion-ios-person"></i> {{ $post->user->perfil->fullname }}</p>

                <div class="social">
                    <div class="fb-share-button" 
                        data-href="{{ URL::current() }}" 
                        data-layout="button_count">
                    </div>
    
                    <a class="twitter-share-button"
                        href="https://twitter.com/intent/tweet?text={{ $post->post_title }}"
                        data-hashtags="Bb3D,Impresion3D,3D,RecuerdosPerdurables,Bebé,Maternidad"
                        data-text="custom share text">
                    Tweet</a>
                </div>

                {{-- <a href="https://web.whatsapp.com/send?text={{ URL::current() }}" data-action="share/whatsapp/share" target="_blank">Share via Whatsapp</a> --}}
            </div>

            <div class="entry-content">
                {!! html_entity_decode($post->post_content, ENT_HTML5) !!}
            </div>

            
        </div>
        <div class="col-md-3 sidebar">

            <h2 class="sidebar-title">Posts</h2>

            <form class="text-center" action="{{ route('post.search') }}" method="get" role="search">
                <input type="search" name="s" id="" 
                placeholder="Buscar en el sitio..." 
                aria-label="Buscar contenido en el sitio">
                <button class="btn-back">Buscar</button>
            </form>

            <h2 class="sidebar-title">Categorías</h2>
                <ul>
                    @foreach ($categories as $category)
                        <li><a href="{{ route('post.searchCat', $category->category_name) }}">{{ $category->category_name }}</a></li>
                    @endforeach
                </ul>

        </div>
    </article>


@endsection
