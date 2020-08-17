<?php

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



Route::group(['middleware' => ['web']], function(){
    Route::get('/', function () {
        return view('home');
    })->name('home');
    Route::get('/login', function () {
        return view('login');
    });
    Route::get('/registeration', function () {
        return view('registeration');
    });
    Route::post('/register',[
        'uses'=>'UsersController@register',
        'as'=>'register'
    ]);
    Route::post('/login', [
        'uses'=>'UsersController@login',
        'as'=>'login'
    ]);
    Route::get('/logout', [
        'uses'=>'UsersController@logout',
        'as'=>'logout'
    ]);
    Route::get('/dashboard', [
        'uses'=>'UsersController@getDashboard',
        'as'=>'dashboard',
        'middleware'=>'auth'
    ]);

    Route::get('/account', [
        'uses'=>'UsersController@getAccount',
        'as'=>'account',
        'middleware'=>'auth'
    ]);

    Route::post('/updateAccount', [
        'uses'=>'UsersController@postSaveAccount',
        'as'=>'account.save',
        'middleware'=>'auth'
    ]);
    
    Route::get('/getAccountImg', [
        'uses'=>'UsersController@getAccountImg',
        'as'=>'account.image',
    ]);

    Route::post('/createPost', [
        'uses'=>'PostController@createPost',
        'as'=>'createPost',
        'middleware'=>'auth'
    ]);

    Route::get('/deletePost/{id}', [
        'uses'=>'PostController@deletePost',
        'as'=>'deletePost',
        'middleware'=>'auth'
    ]);
    Route::post('/edit', [
        'uses'=>'PostController@editPost',
        'as'=>'edit',
    ]);
    Route::post('/like', [
        'uses'=>'PostController@likePost',
        'as'=>'like',
    ]);
});