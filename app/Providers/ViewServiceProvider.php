<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('crearespectador', function () {
            return optional(auth()->user())->isAn('tecnico') && optional(auth()->user())->espectadorCount() < 3;
        });

        Blade::if('tablausuarios', function () {
            return optional(auth()->user())->isNotAn('admin') && optional(auth()->user())->espectadorCount() == 0;
        });


        Blade::if('listusuarios', function () {
            return optional(auth()->user())->isAn('admin') || optional(auth()->user())->isAn('tecnico');
        });

        Blade::if('fotoperfil', function () {
            return  auth()->user()->image == null;
//            return optional(auth()->user())->isAn('espectador') || (optional(auth()->user())->isAn('Tecnico') || auth()->user()->image == null);
        });


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
