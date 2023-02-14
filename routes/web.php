<?php

use App\Models\Post;
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
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {
    // find a post by its slug and pass it to a view called "post"

    $post = Post::find($slug);

    return view('post', [
        'post' => $post
    ]);

    // $path = __DIR__ . "/../resources/posts/{$slug}.html";

    // $post = cache()->remember("posts.{$slug}", 1200, fn() => file_get_contents($path));

    // if (!file_exists($path)) {
    //     return redirect('/');
    // }

    // return view('post', [
    //     'post' => $post
    // ]);
})->where('post', '[A-z_\-]+');