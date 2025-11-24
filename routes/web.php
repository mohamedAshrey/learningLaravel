<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
Use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group( ['middleware' => 'auth'], function (){
    
    Route::get('posts', [ PostController::class, 'index' ])->name('posts.index');

    Route::get('posts/{post}', [ PostController::class, 'show'])->name('posts.show');

    Route::get('/post/create',[ PostController::class, 'create' ])->name('posts.create');

    Route::post('posts', [ PostController::class, 'store' ])->name('posts.store');

    Route::get('posts/{post}/edit',[ PostController::class, 'edit' ])->name('posts.edit');

    Route::put('posts/{post}', [ PostController::class, 'update' ])->name('posts.update');

    Route::delete('posts/{post}', [ PostController::class, 'destroy' ])->name('posts.destroy');

    Route::get('trashes', [ PostController::class, 'trashes' ])->name('trashes.index');

    Route::post('trashes/{post}/restore', [ PostController::class, 'restore' ])->name('trashes.restore');

    Route::delete('trashes/{post}/force-delete', [ PostController::class, 'forceDelete' ])->name('trashes.force-delete');

    //  Route ( Comments )

    Route::get('comments/{post}', [ CommentController::class, 'index' ])->name('comments.index');

    Route::get('comments/{post}/create', [ CommentController::class, 'create' ])->name('comments.create');

    Route::post('comments/{post}', [ CommentController::class, 'store' ])->name('comments.store'); 

    Route::get('comments/{comment}/edit', [ CommentController::class, 'edit'])->name('comments.edit');

    Route::put('comments/{comment}', [ CommentController::class, 'update'])->name('comments.update');

    Route::delete('comments/{comment}', [ CommentController::class, 'destroy'])->name('comments.destroy');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
