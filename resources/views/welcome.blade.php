@extends('layouts.app')
@section('content')
    <div class="content-welcome view">

        <div class="mask pattern-2 d-flex flex-column justify-content-center align-items-center">
            <h1 class="text-center display-4 text-white" style="font-family: 'Bungee', cursive;">Bienvenido a Estadisticas Futbolisticas</h1>
            <p class="text-white h1">Una forma sencilla de llevar las estadisticas de tu equipo de futbol</p>
        </div>
    </div>

    <div class="container bg-primary text-white p-4 rounded border border-light">
        <h2 class="">Con nuestra aplicación podras realizar un seguimiento
            a tu equipo de futbol. Nuestro sistema cuenta con diferentes tipos
            de estadisticas :</h2>
        <ul>
            <li class="lead">Lista de los jugadores de tu equipo</li>
            <li class="lead">Detalle de cada Jugador</li>
            <li class="lead">Cantidad de partidos jugados por cada jugador</li>
            <li class="lead">Tabla de goleadores</li>
            <li class="lead">Promedio de gol de cada jugador</li>
            <li class="lead">Cantidad de partidos jugados por el equipo
                <ul>
                    <li class="lead">Partidos Ganados</li>
                    <li class="lead">Partidos Perdidos</li>
                    <li class="lead">Partidos empatados</li>
                </ul>
            </li>

        </ul>
    </div>

    <div class="m-4 text-center">

        <h5 class="lead">¿ Aun no estas registrado?
            <a href="{{url('register')}}"> Registrate aqui</a>
        </h5>

    </div>
@endsection