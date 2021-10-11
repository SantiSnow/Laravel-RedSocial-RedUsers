<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', [UsersController::class, 'login']);
Route::post('/register', [UsersController::class, 'register']);
Route::post('/logout', [UsersController::class, 'logout']);

Route::post('/profile', [UsersController::class, 'profile']);
Route::post('/posts', [UsersController::class, 'posts_user']);

Route::post('/post', [PostController::class, 'createPost']);
Route::post('/post-delete', [PostController::class, 'deletePost']);
