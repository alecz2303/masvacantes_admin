<?php

use App\Models\Post;
use App\Models\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $user = User::find(34);
    dd($user->empresa->empresa);
    $posts = Post::all();
    Debugbar::info($posts);
    Log::alert("message");
    return view('home', compact('posts'));
});

Route::get('post/{slug}', function($slug){
	$post = Post::where('slug', '=', $slug)->firstOrFail();
	return view('post', compact('post'));
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
