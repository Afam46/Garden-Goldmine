<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.post.posts', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.post.post_create', compact('categories'));
    }

    public function store(Request $request)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
            'desc' =>  ['required'],
            'category_id' =>  ['required','exists:categories,id'],
            'img' =>  ['required'],
        ]);
        
        $img = $request->file('img');
        $path = Storage::putFile('public',$img);

        Post::create([
            'title' => $request['title'],
            'desc' => $request['desc'],
            'category_id' => $request['category_id'],
            'img' => $path,
        ]);

        return redirect(route('posts'));
    }

    public function show(Post $post)
    {
        return view('admin.post.post_show', compact('post'));
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.post.post_edit', compact('post','categories'));
    }

    public function update(Request $request, Post $post)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
            'desc' =>  ['required'],
            'category_id' =>  ['required'],
        ]);

        Post::where('id', $post->id)->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'category_id' => $request->category_id,
        ]);

        return redirect(route('posts'));
    }

    public function delete(Post $post)
    {
        Post::destroy($post->id);

        return redirect(route('posts'));
    }
}
