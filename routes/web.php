<?php

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'App\Http\Controllers\WelcomeController@users');

Route::get('/email',function(){
    return new NewUserWelcomeMail();
});

Route::post('comment/{user}/{post}', 'App\Http\Controllers\CommentsController@store');
Route::post('reply/{comment_id}', 'App\Http\Controllers\CommentsController@storeReply');
Route::post('like/{post_id}', 'App\Http\Controllers\LikePostController@store');
Route::post('likeOnComment/{comment_id}', 'App\Http\Controllers\LikeOnCommentController@store');

Route::get('profile/followersview', function () {
    return view('profile.followersview');
})->middleware('auth');
Route::get('profile/followingview', function () {
    return view('profile.followingview');
})->middleware('auth');


Route::post('follow/{user}', 'App\Http\Controllers\FollowsController@store');
Route::get('users/{user}', 'App\Http\Controllers\ProfilesController@index')->name('profile.show');
Route::get('users/{user}/edit', 'App\Http\Controllers\ProfilesController@edit')->name('profile.edit');
Route::patch('users/{user}', 'App\Http\Controllers\ProfilesController@update')->name('profile.update');

Route::get('ntf', function () {
    $notifications = auth()->user()->notifications;
    return view('notificationView',compact('notifications'));
});

Route::get('/p/{post}','App\Http\Controllers\PostsController@show')->name('p.show');

Route::get('posts/showall',function () {
    return view('posts.showall');
})->middleware('auth');

Route::post('/p','App\Http\Controllers\PostsController@store')->name('p.store');
Route::get('/p', function () {
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\PostsController::class, 'index'])->name('home');
