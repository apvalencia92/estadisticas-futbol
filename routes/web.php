<?php


Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function () {

    /***************************
     *      Usuarios           *
     ***************************/
    Route::resource('usuarios', 'Usercontroller');
    Route::put('usuarios/picture/{usuario}', 'UserController@update_image')->name('usuarios.actualizarimagen');

    /***************************
     *        Equipos           *
     ***************************/
    Route::get('equipos', 'EquipoController@index')->name('equipos.index');
    Route::get('equipos/{equipo}', 'EquipoController@show')->name('equipos.show');

    Route::get('equipos/{equipo}/edit', 'EquipoController@edit')->name('equipos.edit');
    Route::put('equipos/{equipo}','EquipoController@update')->name('equipos.update');
});

