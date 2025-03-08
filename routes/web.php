<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\GardenFlowerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Middleware\AdminMiddleware;

Route::middleware(AdminMiddleware::class)
->prefix('admin')->group(function(){

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)->prefix('users')->group(function(){
    Route::get('/', 'index')->name('users');
    Route::get('/create', 'create')->name('user.create');
    Route::post('/', 'store')->name('user.store');
    Route::get('/{user}', 'show')->name('user.show');
    Route::get('/{user}/edit', 'edit')->name('user.edit');
    Route::post('/{user}/update', 'update')->name('user.update');
    Route::get('/{user}/delete', 'delete')->name('user.delete');
});

Route::controller(FlowerController::class)->prefix('flowers')->group(function(){
    Route::get('/', 'index')->name('flowers');
    Route::get('/create', 'create')->name('flower.create');
    Route::post('/', 'store')->name('flower.store');
    Route::get('/{flower}', 'show')->name('flower.show');
    Route::get('/{flower}/edit', 'edit')->name('flower.edit');
    Route::post('/{flower}/update', 'update')->name('flower.update');
    Route::get('/{flower}/delete', 'delete')->name('flower.delete');
});

Route::controller(GardenFlowerController::class)->prefix('garden_flowers')->group(function(){
    Route::get('/', 'index')->name('garden_flowers');
    Route::get('/create', 'create')->name('garden_flower.create');
    Route::post('/', 'store')->name('garden_flower.store');
    Route::get('/{garden_flower}', 'show')->name('garden_flower.show');
    Route::get('/{garden_flower}/edit', 'edit')->name('garden_flower.edit');
    Route::post('/{garden_flower}/update', 'update')->name('garden_flower.update');
    Route::get('/{garden_flower}/delete', 'delete')->name('garden_flower.delete');
});

Route::controller(CategoryController::class)->prefix('categories')->group(function(){
    Route::get('/', 'index')->name('categories');
    Route::get('/create', 'create')->name('category.create');
    Route::post('/', 'store')->name('categories.store');
    Route::get('/{category}', 'show')->name('category.show');
    Route::get('/{category}/edit', 'edit')->name('category.edit');
    Route::post('/{category}/update', 'update')->name('category.update');
    Route::get('/{category}/delete', 'delete')->name('category.delete');
});

});

Auth::routes();

Route::get('{page}', function(){
    return view('welcome');
})->where('page','.*');