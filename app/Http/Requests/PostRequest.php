<?php

namespace bagrap\Http\Requests;

use bagrap\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {

        if ($request->isMethod('POST')) {

            return [
                
                'titulo_post'    => 'required|string|unique:posts,post_title',
                'content_post'   => 'required',
                'thumbnail_post' => 'required|image',
                'publish_post'   => 'required',
                'description_post' => 'required',
                'category-check' => 'required',

            ];

        } elseif ($request->isMethod('PUT') || $request->isMethod('PATCH')) {

            return [
                
                'titulo_post'    => ['required', 'string', Rule::unique('posts', 'post_title')->ignore(Post::findOrFail($request->input('post_id'))->id)],
                'content_post'   => 'required',
                'thumbnail_post' => 'image',
                'publish_post'   => 'required',
                'description_post' => 'required',
                'category-check' => 'required',

            ];

        }

    }
}
