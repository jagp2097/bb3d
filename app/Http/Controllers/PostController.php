<?php

namespace bagrap\Http\Controllers;

use bagrap\Post;
use bagrap\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use bagrap\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // admin
        if (Auth::check() && Auth::user()->isAdmin()) {
            
            return view('posts.index', [
                'posts' => Post::all(),
            ]);

        } else {

            return abort(401, 'This action is unauthorized.');

        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // admin
        if (Auth::check() && Auth::user()->isAdmin()) {

            return view('posts.create', [
                'post' => new Post()
            ]);

        } else {
            return abort(401, 'This action is unauthorized.');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // admin
        if (Auth::check() && Auth::user()->isAdmin()) {

            $post = new Post();
    
            if($request->hasFile('thumbnail_post')) {
    
                //Agarro el archivo
                $thumb = $request->file('thumbnail_post');
                
                //Armo la referencia unica para identificar a la imagen y poder almacenarla en la DB
                $referencia = time().$thumb->getClientOriginalName();
    
                //Muevo la imagen a la carpeta pública con el nombre armado en la referencia
                $thumb->move(public_path().'/images/posts_thumbnails', $referencia);
    
                $post->post_author = Auth::user()->id;
                $post->post_title = $request->input('titulo_post');
                $post->post_title_slug = Str::slug($request->input('titulo_post'));
                $post->post_content = $request->input('content_post');
                $post->post_description = $request->input('description_post');
                $post->post_thumbnail = $referencia;
                $post->post_published = $request->input('publish_post');
    
                $post->save();
                
                foreach ($request->input('category-check') as $check) {
    
                    $category = Category::findOrFail($check);
                    $post->categories()->attach($post->id, [
                        'category_id' => $category->id
                    ]);
    
                }
    
                return redirect()->to(route('post.index'));
    
            }
        } else {

            return abort(401, 'This action is unauthorized.');
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \bagrap\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post_slug)
    {

        $post = Post::where('post_title_slug', '=', $post_slug)->first();
        $categories = Category::all();

        return view('posts.show', [
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \bagrap\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // admin
        if (Auth::check() && Auth::user()->isAdmin()) {

            return view('posts.create', [
                'post' => $post
            ]);

        } else {

            return abort(401, 'This action is unauthorized.');
            
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \bagrap\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // admin
        if (Auth::check() && Auth::user()->isAdmin()) {

            if($request->hasFile('thumbnail_post')) {
    
                //Agarro el archivo
                $thumb = $request->file('thumbnail_post');
                
                //Armo la referencia unica para identificar a la imagen y poder almacenarla en la DB
                $referencia = time().$thumb->getClientOriginalName();
    
                //Muevo la imagen a la carpeta pública con el nombre armado en la referencia
                $thumb->move(public_path().'/images/posts_thumbnails', $referencia);

                $post->update([
                    'post_author' => Auth::user()->id,
                    'post_title' => $request->input('titulo_post'),
                    'post_title_slug' => Str::slug($request->input('titulo_post')),
                    'post_content' => $request->input('content_post'),
                    'post_description' => $request->input('description_post'),
                    'post_thumbnail' => $referencia,
                    'post_published' => $request->input('publish_post'),
                ]);
    
                // $post->post_author = Auth::user()->id;
                // $post->post_title = $request->input('titulo_post');
                // $post->post_title_slug = Str::slug($request->input('titulo_post'));
                // $post->post_content = $request->input('content_post');
                // $post->post_description = $request->input('description_post');
                // $post->post_thumbnail = $referencia;
                // $post->post_published = $request->input('publish_post');
    
                // $post->save();
                
                foreach ($request->input('category-check') as $check) {
    
                    $category = Category::findOrFail($check);
                    $post->categories()->sync($post->id, [
                        'category_id' => $category->id
                    ]);
    
                }
                
            } else {
                    
                $post->update([
                    'post_author' => Auth::user()->id,
                    'post_title' => $request->input('titulo_post'),
                    'post_title_slug' => Str::slug($request->input('titulo_post')),
                    'post_content' => $request->input('content_post'),
                    'post_description' => $request->input('description_post'),
                    'post_published' => $request->input('publish_post'),
                ]);

                // $post->post_author = Auth::user()->id;
                // $post->post_title = $request->input('titulo_post');
                // $post->post_title_slug = Str::slug($request->input('titulo_post'));
                // $post->post_content = $request->input('content_post');
                // $post->post_description = $request->input('description_post');
                // $post->post_thumbnail = $post->post_thumbnail;
                // $post->post_published = $request->input('publish_post');
    
                // $post->save();
                
                foreach ($request->input('category-check') as $check) {
    
                    $category = Category::findOrFail($check);
                    $post->categories()->sync($post->id, [
                        'category_id' => $category->id
                    ]);
    
                }
    
            }
    
            return redirect()->to(route('post.index'));

        } else {

            return abort(401, 'This action is unauthorized.');
            
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \bagrap\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // admin
        if (Auth::check() && Auth::user()->isAdmin()) {

            $post->delete($post->id);
    
            return redirect()->to(route('post.index'));

        } else {

            return abort(401, 'This action is unauthorized.');

        }

    }


    public function list()
    {
        return view('posts.result', [
            'posts' => Post::where('post_published', 1)->get(),
            'categories' => Category::all()
        ]);
    }


    public function search(Request $request)
    { 

        return view('posts.result', [
            'result_search' => Post::search($request->input('s'))->get(),
            'search_input' => $request->input('s'),
            'categories' => Category::all()
        ]);

    }

    public function searchCategory($category)
    {

        $category = Category::where('category_name', '=', $category)->first();

        $result_search_category = collect();
        foreach ($category->posts as $post) {

            if ($post->post_published == 1)
                $result_search_category->push($post); 

        }

        return view('posts.result', [
            'result_search_category' => $result_search_category,
            'category' => $category,
            'categories' => Category::all()
        ]);
    }


}
