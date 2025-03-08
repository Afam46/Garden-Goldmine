<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function indexVue(){
        return Category::all();
    }
    public function index()
    {   
        $categories = Category::all();
        return view('admin.category.categories', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.category_create');
    }

    public function store(Request $request)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
        ]);

        Category::create($request->all());

        return redirect(route('categories'));
    }

    public function show(Category $category)
    {
        $flowers = $category->flowers;

        return view('admin.category.category_show', compact('category','flowers'));
    }

    public function edit(Category $category)
    {
        return view('admin.category.category_edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
        ]);

        Category::where('id', $category->id)->update([
            'title' => $request->title  
        ]);

        return redirect(route('categories'));
    }

    public function delete(Category $category)
    {
        Category::destroy($category->id);

        return redirect(route('categories'));
    }
}
