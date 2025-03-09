<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GardenFlowerController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/user', function() {
    return Auth::user();
});

Route::get('/email', function(){
    return User::get(['email']);
});
Route::post('/check' , function(Request $request){
    $user = User::where('email',$request['email'])->first();
    if(Hash::check($request['password'], $user->password)) {
        return true;
    }else{
        return false;
    }
});

Route::get('/top', function(){
    return User::orderBy('balance', 'desc')->get(['id','name','balance']);
});

Route::get('/balance', function(){
    return Auth::user();
});
Route::post('/balance/update', function(Request $request){
    Auth::user()->update([
        'balance' => $request->balance
    ]);
});
Route::get('/user_capacity', function(){
    return Auth::user()->capacity;
});
Route::post('/user_capacity/update', function(Request $request){
    User::where('id',Auth::id())->update(['capacity' => $request->capacity]);
});

Route::get('/name', function(){
    return User::find(Auth::id());
});

Route::prefix('garden_flowers')->controller(GardenFlowerController::class)
->group(function(){
    Route::get('/', 'indexVue');
    Route::post('/', 'storeVue');
    Route::get('/count', 'countVue');
    Route::get('/show/{garden_flower}','showVue');
    Route::post('/update','updateVue');
    Route::get('/destroy/{garden_flower}', 'destroyVue');
});

Route::prefix('categories')->controller(CategoryController::class)->group(function(){
    Route::get('/', 'indexVue');
});

Route::prefix('flowers')->controller(FlowerController::class)->group(function(){
    Route::get('/', 'indexVue')->name('flowers');
});