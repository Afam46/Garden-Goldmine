<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\GardenFlower;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GardenFlowerController extends Controller
{
    public function indexVue(){
        return Auth::user()->buyedFlowers;
    }

    public function countVue(){
        return Auth::user()->buyedFlowers->count();
    }

    public function storeVue(Request $request){
        GardenFlower::create([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'use_time_water' => $request->use_time_water,
            'user_id' => Auth::id(),
            'time' => time()/60,
            'img' => $request->img,
            'descrip' => $request->descrip,
        ]);
    }
    public function updateVue(Request $request){
        GardenFlower::find($request->id)->update([
            'time' => $request->now,
            'stage' => $request->stage,
        ]);
    }
    public function showVue(GardenFlower $garden_flower){
        return $garden_flower;
    }
    public function destroyVue(GardenFlower $garden_flower){
        GardenFlower::destroy($garden_flower->id);
    }

    public function index()
    {
        $garden_flowers = GardenFlower::all();
        return view('admin.garden_flower.garden_flowers', compact('garden_flowers'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('admin.garden_flower.garden_flower_create', compact('categories','users'));
    }

    public function store(Request $request)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
            'price' =>  ['required'],
            'category_id' =>  ['required','exists:categories,id'],
            'img' =>  ['required'],
            'descrip' => ['required'],
            'stage' => ['required'],
            'user_id' => ['required','exists:users,id'],
        ]);

        $image = $request['img'];
        $name = md5($image->getClientOriginalName()).'.'.
        $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        GardenFlower::create([
            'title' => $request['title'],
            'price' => $request['price'],
            'category_id' => $request['category_id'],
            'use_time_water' => $request['use_time_water'],
            'img' => url( '/storage' . '/' . $filePath, ),
            'descrip' => $request['descrip'],
            'stage' => $request['stage'],
            'user_id' => $request['user_id'],
        ]);

        return redirect(route('garden_flowers'));
    }

    public function show(GardenFlower $garden_flower)
    {
        return view('admin.garden_flower.garden_flower_show', compact('garden_flower'));
    }

    public function edit(GardenFlower $garden_flower)
    {
        $categories = Category::all();
        $users = User::all();

        return view('admin.garden_flower.garden_flower_edit',
        compact('garden_flower','categories','users'));
    }

    public function update(Request $request, GardenFlower $garden_flower)
    {   
        $validations = $request->validate([
            'title' =>  ['required'],
            'price' =>  ['required'],
            'category_id' =>  ['required'],
            'img' =>  ['required'],
            'descrip' => ['required'],
            'stage' => ['required'],
            'user_id' => ['required','exists:users,id']
        ]);

        
        $image = $request['img'];
        $name = md5($image->getClientOriginalName()).'.'.
        $image->getClientOriginalExtension();
        $filePath = Storage::disk('public')->putFileAs('/images', $image, $name);

        GardenFlower::where('id', $garden_flower->id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'use_time_water' => $request->use_time_water,
            'img' => url( '/storage' . '/' . $filePath, ),
            'descrip' => $request['descrip'],
            'stage' => $request['stage'],
            'user_id' => $request['user_id'],
        ]);

        return redirect(route('garden_flowers'));
    }

    public function delete(GardenFlower $garden_flower)
    {
        GardenFlower::destroy($garden_flower->id);

        return redirect(route('garden_flowers'));
    }
}
