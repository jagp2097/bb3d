@extends('layouts.app')
@section('scripts')
{{-- <script src="https://cdn.tiny.cloud/1/o10tftemcs0cjz76alt9m303zfx7go1k40if9xgu4wc292sr/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    var editor_config = {
        path_absolute : "{{ url('/') }}/",
        selector: "textarea.content",
        plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
            
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }
            
            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };
    
    tinymce.init(editor_config);
</script>
<script src="{{ asset('js/preview-image.js') }}"></script>
<script src="{{ asset('js/category-crud.js') }}"></script>
<script>
    $(document).ready(function() {
        indexCategory('{{ route('category.index') }}');
    });
</script>
@endsection
@section('content')

<section id="clients">

@if ($post->exists)
    <form action="{{ route('post.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf 
    @method('PUT')   
    <input type="hidden" name="post_id" value="{{ $post->id }}">
@else
    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
@endif
        <div class="row">

            <div class="col-md-9 justify-content-center">
                
                <div class="section-header">
                    <div class="row">
                        <div class="col-sm-9 col-md-9 col-lg-9">
                            @if ($post->exists)
                            <h4>Editar post</h4>
                            @else
                            <h4>Crear post</h4>
                            @endif
                        </div>
                        <div class="col-sm-3 col-md-3 col-lg-3 text-right">
                            <a class="btn-sec" href="{{ route('post.index') }}">Ir a los posts</a>
                        </div>
                    </div>
                </div>

                <div class="row form">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <h3>Título del post</h3>
                        <input class="form-control{{ $errors->has('titulo_post') ? ' is-invalid' : '' }}" type="text" name="titulo_post" value="{{ old('titulo_post', $post->post_title) }}">        
                        
                        @if ($errors->has('titulo_post'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('titulo_post') }}</strong>
                        </span>
                        @endif
                    
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 p-3">
                        <textarea class="content form-control{{ $errors->has('content_post') ? ' is-invalid' : '' }}" name="content_post" rows="18">{{ old('content_post', $post->post_content) }}</textarea><br>

                        @if ($errors->has('content_post'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('content_post') }}</strong>
                        </span>
                        @endif

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-right">
                        @if ($post->exists)
                            <input class="btn-edit" type="submit" value="Editar post">
                        @else
                            <input class="btn-edit" type="submit" value="Crear post">
                        @endif
                    </div>
                </div>

            </div>

            <div class="col-md-3 sidebar">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="justify-content-center">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="text-center">
                                    <h3 class="sidebar-title">Thumbnail</h3>
                                    <div id="img-cont" class="col-lg-12 col-md-12 col-sm-12">
                                        @if ($post->exists)
                                        <img id="output_image" class="img-profile" src="{{ asset('images/posts_thumbnails') }}/{{ $post->post_thumbnail }}"/><br>
                                        @else
                                        <img id="output_image" class="img-profile"/><br>
                                        @endif
                                    </div>
                                    <input class="form-control{{ $errors->has('thumbnail_post') ? ' is-invalid' : '' }} form-control-file" type="file" name="thumbnail_post" onchange="preview_image(event)" value="">
                                    @if ($errors->has('thumbnail_post'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger">{{ $errors->first('thumbnail_post') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 class="sidebar-title">Publicar</h3>

                        <input type="radio" name="publish_post" value="1" 
                            @if ($post->exists && $post->post_published == 1)
                            checked    
                            @elseif ($post->exists && $post->post_published == 0)
                            @else
                            checked
                            @endif
                            > <label>Si</label>
                            
                            <input type="radio" name="publish_post" value="0"
                            @if ($post->exists && $post->post_published == 0)
                            checked
                            @elseif ($post->exists && $post->post_published == 1)
                            @else
                            @endif
                        > <label>No</label>       
                        @if ($errors->has('publish_post'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('publish_post') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 class="sidebar-title">Descripción</h3>
                        <textarea class="form-control{{ $errors->has('description_post') ? ' is-invalid' : '' }}" name="description_post" cols="70" rows="2" spellcheck="true">{{ old('description_post', $post->post_description) }}</textarea>

                        @if ($errors->has('description_post'))
                        <span class="invalid-feedback" role="alert">
                            <strong class="text-danger">{{ $errors->first('description_post') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <h3 class="sidebar-title">Categoría</h3>
                        
                        @if ($errors->has('category-check'))
                        <span class="text-danger" role="alert">
                            <strong>{{ $errors->first('category-check') }}</strong>
                        </span>
                        @endif
                        
                        <div id="category-index">
                            
                        </div>

                        
                        <label>Añadir categoría</label>
                        
                        <div id="for-new-cate">
                            <input id="category_name" type="text" name="category_name">
                            <small id="category_errors" class="text-danger"></small>
                            <button type="button" class="btn-sec" onclick="createCategory('{{ route('category.store') }}')">Añadir</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </form>
</section>

   
    
@endsection