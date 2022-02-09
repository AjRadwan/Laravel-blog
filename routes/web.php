<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
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
    Route::get('blog/{post}/edit', 'edit')->name('blog.edit');
    Route::put('blog/{post}', 'update')->name('blog.update');
    Route::delete('blog/{post}', 'delete')->name('blog.delete');
    Route::post('blog/',  'store')->name('blog.store');    
});



Route::get('about', function () { 
    return view('about');
})->name('about');

Route::get('contact', [ContactController::class, 'index'])->name('contact');

//Category resource controler
Route::resource('categories', CategoryController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
