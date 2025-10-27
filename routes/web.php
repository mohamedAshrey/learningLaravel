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


Route::get('posts', [ PostController::class, 'index' ])->name('posts.index')->middleware('auth');

Route::get('posts/{post}', [ PostController::class, 'show'])->name('posts.show')->middleware('auth');

Route::get('/post/create',[ PostController::class, 'create' ])->name('posts.create')->middleware('auth');

Route::post('posts', [ PostController::class, 'store' ])->name('posts.store')->middleware('auth');

Route::get('posts/{post}/edit',[ PostController::class, 'edit' ])->name('posts.edit')->middleware('auth');

Route::put('posts/{post}', [ PostController::class, 'update' ])->name('posts.update')->middleware('auth');

Route::delete('posts/{post}', [ PostController::class, 'destroy' ])->name('posts.destroy')->middleware('auth');

Route::get('trashes', [ PostController::class, 'trashes' ])->name('trashes.index')->middleware('auth');

Route::post('trashes/{post}/restore', [ PostController::class, 'restore' ])->name('trashes.restore')->middleware('auth');

Route::delete('trashes/{post}/force-delete', [ PostController::class, 'forceDelete' ])->name('trashes.force-delete')->middleware('auth');

//  Route ( Comments )

Route::get('comments/{post}', [ CommentController::class, 'index' ])->name('comments.index')->middleware('auth');

Route::get('comments/{post}/create', [ CommentController::class, 'create' ])->name('comments.create')->middleware('auth');

Route::post('comments/{post}', [ CommentController::class, 'store' ])->name('comments.store')->middleware('auth'); 

Route::get('comments/{comment}/edit', [ CommentController::class, 'edit'])->name('comments.edit')->middleware('auth');

Route::put('comments/{comment}', [ CommentController::class, 'update'])->name('comments.update')->middleware('auth');

Route::delete('comments/{comment}', [ CommentController::class, 'destroy'])->name('comments.destroy')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
