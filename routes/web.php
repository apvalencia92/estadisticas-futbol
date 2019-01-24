<?php


Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::middleware(['auth'])->prefix('usuarios/')->group(function () {


    Route::get('', 'userController@index')->name('users.index');

    Route::get('create', 'UserController@create')->name('users.create');

    Route::get('{user}','UserController@show')->name('users.show');


    Route::post('', 'UserController@store')->name('users.store');

    Route::get('{user}/edit', 'UserController@edit')->name('users.edit');

    Route::put('{user}', 'UserController@update')->name('users.update');
    Route::put('picture/{user}', 'UserController@update_image')->name('users.updateimage');


    Route::delete('{user}', 'UserController@destroy')->name('users.delete');


//    Route::get('espectador','UserController@')


});
