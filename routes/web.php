<?php


Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::pattern('users','[0-9]+');
Route::resource('usuarios', 'Usercontroller')->middleware('auth');
Route::put('usuarios/picture/{usuario}', 'UserController@update_image')->name('usuarios.actualizarimagen');

Route::resource('equipos','EquiposController');