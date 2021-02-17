@extends('layouts.app')
@section('content')

<section id="clients">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12 justify-content-center">
                <div class="section-header">
                    
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <h4>Posts</h4>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 text-right">
                            <a href="{!! route('perfil.show') !!}" class="btn-sec">Perfil</a>
                            <a href="{{ route('post.create') }}" class="btn-back">Nuevo post</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        
        <section id="content">
            <div class="table-responsive">
                <table class="table table-bb">
                    <thead class="text-center">
                        <th class="text-center align-middle" scope="col">Titulo</th>
                        <th class="text-center align-middle" scope="col">Autor</th>
                        <th class="text-center align-middle" scope="col">Categorías</th>
                        <th class="text-center align-middle" scope="col">Publicada</th>
                        <th class="text-center align-middle" scope="col">Fecha</th>
                        <th class="text-center align-middle" scope="col"></th>
                        <th class="text-center align-middle" scope="col"></th>
                        <th class="text-center align-middle" scope="col"></th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td class="align-middle text-center">{{ $post->post_title }}</td>
                            <td class="align-middle text-center">{{ $post->user->perfil->fullname }}
                            </td>
                            <td class="align-middle text-center">
                                @foreach ($post->categories as $category)
                                    @if ($category->count() > 1)
                                        {{ $category->category_name }},
                                    @else
                                        {{ $category->category_name }}
                                    @endif
                                @endforeach
                            </td>
                            <td class="align-middle text-center">
                                {{ $post->post_published ? 'Si' : 'No' }}
                            </td>
                            <td class="align-middle text-center">
                                {{ $post->created_at }}
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('post.show', $post->post_title_slug) }}" class="btn-back">Ver post</a>
                            </td>
                            <td class="align-middle text-center">
                                <a href="{{ route('post.edit', $post->id) }}" class="btn-edit">Editar post</a>
                            </td>
                            <td class="align-middle text-center">
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    @method('DELETE')
                                    <button type="submit" class="btn-del">Eliminar post</button>
                                    @csrf
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</section>


@endsection