@extends('admin.app')
@section('title','Editar equipo')
@section('pagina_actual','Editar Equipo')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Card -->
                <div class="card">
                    <h5 class="card-header light-blue white-text text-center py-4">Editar Informacion del equipo</h5>
                    <!-- Card body -->
                    <div class="card-body">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <h2>Por favor corrige los siguientes errores</h2>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif

                    <!-- Material form register -->
                        <form action="{{ route('equipos.update',$equipo) }}" method="POST"
                              enctype="multipart/form-data">


                        @csrf
                        @method('PUT')

                        <!-- Material input text -->
                            <div class="md-form">
                                <i class="fas fa-futbol prefix active"></i>
                                <input type="text" id="name" name="name" class="form-control"
                                       value="{{ old('name',$equipo->name) }}">
                                <label for="materialFormCardNameEx" class="font-weight-light">Nombre equipo</label>
                            </div>


                            <div style="margin: 60px 0">
                                <div class="form-group">
                                    <label for="logo">Logo</label>
                                    <input type="file" name="logo" id="logo" class="form-control-file"
                                           @change="onFileSelected" value="">
                                </div>

                                <figure>
                                    <img width="200" height="200"
                                         :src="imagen == '' ? '{{ asset("{$equipo->getImage()}") }}' : imagen"
                                         alt="Foto perfil de usuario">
                                </figure>
                            </div>


                            <div class="md-form form-sm">
                                <i class="fas fa-lock prefix active"></i>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $equipo->fecha_nacimiento) }}">
                                <label for="fecha_nacimiento" class="active">Fecha fundacion equipo</label>
                            </div>


                            <div class="text-center py-4 mt-3">
                                <button class="btn light-blue" type="submit">Actualizar</button>
                            </div>
                        </form>
                        <!-- Material form register -->

                    </div>
                    <!-- Card body -->

                </div>
                <!-- Card -->

                <!--============================

                ==============================-->


                {{--<div class="card cascading-modal">--}}
                    {{--<h5 class="card-header light-blue white-text text-center py-4">Editar Informacion del equipo</h5>--}}
                    {{--<div class="card-body box-profile">--}}

                        {{--@if($errors->any())--}}
                            {{--<div class="alert alert-danger">--}}
                                {{--<h2>Por favor corrige los siguientes errores</h2>--}}
                                {{--<ul>--}}
                                    {{--@foreach($errors->all() as $error)--}}
                                        {{--<li>{{ $error }}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--@endif--}}

                        {{--<form action="{{ route('equipos.update',$equipo) }}" method="POST"--}}
                              {{--enctype="multipart/form-data">--}}

                            {{--@csrf--}}
                            {{--@method('PUT')--}}


                            {{--Logo--}}
                            {{--<div style="margin: 60px 0">--}}
                                {{--<div class="form-group">--}}
                                    {{--<label for="logo">Logo</label>--}}
                                    {{--<input type="file" name="logo" id="logo" class="form-control-file"--}}
                                           {{--@change="onFileSelected" value="">--}}
                                {{--</div>--}}

                                {{--<figure>--}}
                                    {{--<img width="200" height="200"--}}
                                         {{--:src="imagen == '' ? '{{ asset("{$equipo->getImage()}") }}' : imagen"--}}
                                         {{--alt="Foto perfil de usuario">--}}
                                {{--</figure>--}}
                            {{--</div>--}}

                            {{--Fecha equipo--}}


                            {{--<div class="md-form form-sm">--}}
                                {{--<i class="fas fa-lock prefix active"></i>--}}
                                {{--<input type="password" id="form9" class="form-control">--}}
                                {{--<label for="form9" class="active">Your email</label>--}}
                            {{--</div>--}}


                            {{--Boton--}}
                            {{--<div class="form-group text-center">--}}
                                {{--<button type="submit" class="btn light-blue my-4 waves-effect waves-light">Actualizar--}}
                                    {{--información--}}
                                {{--</button>--}}
                            {{--</div>--}}

                        {{--</form>--}}

                    {{--</div>--}}
                {{--</div>--}}


                <!--============================

                ==============================-->

            </div>
        </div>
    </div>



@endsection