<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flower;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class FlowerController extends Controller
{
    public function indexVue(){
        return Flower::all();
    }

    public function index()
    {
        $flowers = Flower::all();
        return view('admin.flower.flowers', compact('flowers'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.flower.flower_create', compact('categories'));
    }

    public function store(Request $request)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
            'price' =>  ['required'],
            'category_id' =>  ['required','exists:categories,id'],
            'img' =>  ['required'],
            'descrip' => ['required'],
        ]);

        $image = $request['img'];
        $name = md5($image->getClientOriginalName()).'.'.
        $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        Flower::create([
            'title' => $request['title'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
            'use_time_water' => $request['use_time_water'],
            'img' => url( '/storage' . '/' . $filePath, ),
            'descrip' => $request['descrip'],
        ]);

        return redirect(route('flowers'));
    }

    public function show(Flower $flower)
    {
        return view('admin.flower.flower_show', compact('flower'));
    }

    public function edit(Flower $flower)
    {
        $categories = Category::all();

        return view('admin.flower.flower_edit', compact('flower','categories'));
    }

    public function update(Request $request, Flower $flower)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
            'price' =>  ['required'],
            'category_id' =>  ['required'],
            'img' =>  ['required'],
            'descrip' => ['required'],
        ]);

        
        $image = $request['img'];
        $name = md5($image->getClientOriginalName()).'.'.
        $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        Flower::where('id', $flower->id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'use_time_water' => $request->use_time_water,
            'img' => url( '/storage' . '/' . $filePath, ),
            'descrip' => $request['descrip'],
        ]);

        return redirect(route('flowers'));
    }

    public function delete(Flower $flower)
    {
        Flower::destroy($flower->id);

        return redirect(route('flowers'));
    }
}
