<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


//------------------AUTHENTIFICATION------------------
Route::get('register', [RegisterController::class, 'create'])->name('register');
Route::post('register', [RegisterController::class, 'store']);
Route::get("/login", [LoginController::class, 'create'])->name("login");
Route::post("/login", [LoginController::class, 'store']);
Route::post('/logout',[LoginController::class, 'destroy'])->name("logout");


Route::group(["middleware" => "auth"], function () {
Route::get('/', [HomeController::class,'index'])->name('home');

    Route::get('/u/{username}', [HomeController::class,'index'])->name('profile');
});






