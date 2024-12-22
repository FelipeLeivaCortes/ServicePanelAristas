<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function() {
    return redirect()->route('admin.dashboard.index');
});

Route::get('/home', function() {
    return redirect()->route('admin.dashboard.index');
});

Auth::routes(["register" => false]);