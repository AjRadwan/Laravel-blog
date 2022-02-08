<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
 
 
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');



Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('blog/single-post', [BlogController::class, 'show'])->name('single-post');


// to create blog post
Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');

// to Store blog post 
Route::post('blog/', [BlogController::class, 'store'])->name('blog.store');


Route::get('about', function () { 
    return view('about');
})->name('about');

Route::get('contact', [ContactController::class, 'index'])->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
