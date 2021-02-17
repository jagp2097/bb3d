@extends('layouts.app')
@section('content')

<section id="clients">
    <div class="container">
        
        <div class="row">
            
            <div class="col-md-9 justify-content-center">
                <div class="section-header">
                    
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            @isset($result_search_category)
                                <h4>Categoría: "{{ $category->category_name }}"</h4>
                            @endisset

                            @isset($result_search)
                                <h4>Resultados de la búsqueda: "{{ $search_input }}"</h4>
                            @endisset

                            @isset($posts)
                                <h4>Posts</h4>
                            @endisset
                        </div>
                    </div>
                
                </div>

                @isset($result_search_category)
                
                    @foreach ($result_search_category as $post)
                        <div class="row post-result">
                            <div class="col-md-3">
                                <img src="{{ asset('images/posts_thumbnails') }}/{{ $post->post_thumbnail }}" alt="post-thumbnail">
                            </div>
                            <div class="col-md-9">
                                <h2 class="header-result">{{ $post->post_title }}</h2>
                                <div class="excerpt-result">
                                    {!! html_entity_decode($post->excerptPost($post->post_content), ENT_HTML5) !!}
                                </div>
                                <div class="buttons-result float-right">
                                    <a href="{{ route('post.show', $post->post_title_slug) }}" class="btn-sec">Leer más</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    @empty($result_search_category)
                        <div class="row">
                            <h3>Sin resultados</h3>
                        </div>
                    @endempty

                @endisset
            
                @isset($result_search)

                @foreach ($result_search as $post)
                    <div class="row post-result">
                        <div class="col-md-3">
                            <img src="{{ asset('images/posts_thumbnails') }}/{{ $post->post_thumbnail }}" alt="post-thumbnail">
                        </div>
                        <div class="col-md-9">
                            <h2 class="header-result">{{ $post->post_title }}</h2>
                            <div class="excerpt-result">
                                {!! html_entity_decode($post->excerptPost($post->post_content), ENT_HTML5) !!}
                            </div>
                            <div class="buttons-result float-right">
                                <a href="{{ route('post.show', $post->post_title_slug) }}" class="btn-sec">Leer más</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                    @empty($result_search)
                        <div class="row">
                            <h3>Sin resultados</h3>
                        </div>
                    @endempty

                @endisset

                @isset($posts)

                @foreach ($posts as $post)
                    <div class="row post-result">
                        <div class="col-md-3">
                            <img src="{{ asset('images/posts_thumbnails') }}/{{ $post->post_thumbnail }}" alt="post-thumbnail">
                        </div>
                        <div class="col-md-9">
                            <h2 class="header-result">{{ $post->post_title }}</h2>
                            <div class="excerpt-result">
                                {!! html_entity_decode($post->excerptPost($post->post_content), ENT_HTML5) !!}
                            </div>
                            <div class="buttons-result float-right">
                                <a href="{{ route('post.show', $post->post_title_slug) }}" class="btn-sec">Leer más</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                    @empty($posts)
                        <div class="row">
                            <h3>Sin resultados</h3>
                        </div>
                    @endempty

                @endisset


            </div>

            <div class="col-md-3 sidebar">
    
                <h2 class="sidebar-title">Posts</h2>
    
                <form action="{{ route('post.search') }}" method="get" role="search">
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

        </div>

    </div>
</section>
    
    

@endsection