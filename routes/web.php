<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class,'index'])
    ->middleware('auth')
    ->name('home');

//------------------AUTHENTIFICATION------------------
Route::get('register', [RegisterController::class, 'create'])->name('register');
Route::post('register', [RegisterController::class, 'store']);
Route::get("/login", [LoginController::class, 'create'])->name("login");
Route::post("/login", [LoginController::class, 'store']);
Route::post('/logout',[LoginController::class, 'destroy'])->middleware('auth')->name("logout");


Route::group(["middleware" => "auth"], function () {

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::post('/profile/update-images', [ProfileController::class, 'updateImage'])
        ->name('profile.updateImages');

});

//--------------------check_profile---------------------------------------
Route::get('/u/{user:username}', [ProfileController::class, 'index'])
    ->name('profile');





