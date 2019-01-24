<?php


Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('usuarios','Usercontroller')->middleware('auth');
//Route::put('picture/{user}', 'UserController@update_image')->name('users.updateimage');


Route::middleware(['auth'])->prefix('usuarios/')->group(function () {

    Route::get('', 'UserController@index')->name('usuarios.index');

    Route::get('create', 'UserController@create')->name('usuarios.create');

    Route::get('{user}','UserController@show')->name('usuarios.show');


    Route::post('', 'UserController@store')->name('usuarios.store');

    Route::get('{user}/edit', 'UserController@edit')->name('usuarios.edit');

    Route::put('{user}', 'UserController@update')->name('usuarios.update');
    Route::put('picture/{user}', 'UserController@update_image')->name('usuarios.updateimage');


    Route::delete('{user}', 'UserController@destroy')->name('usuarios.destroy');



});
