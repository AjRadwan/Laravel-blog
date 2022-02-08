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
 
Route::controller(BlogController::class)->group(function () {
    Route::get('blog', 'index')->name('blog.index');
    Route::get('blog/create', 'create')->name('blog.create');
    Route::get('blog/{post:slug}', 'show')->name('single-post');
    Route::post('blog/',  'store')->name('blog.store');
    
});

Route::get('about', function () { 
    return view('about');
})->name('about');

Route::get('contact', [ContactController::class, 'index'])->name('contact');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
