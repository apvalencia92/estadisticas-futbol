@extends('admin.app')
@section('title','Registro de usuarios')
@section('pagina_actual','Registro de usuarios')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header light-blue white-text text-center py-4">
                        <strong>Registrar espectador</strong>
                    </h5>
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

                        <form method="post" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
                            @csrf

                            {{-- Nombre --}}
                            <div class="md-form">
                                <i class="fas fa-user-alt prefix grey-text"></i>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                <label for="name" class="font-weight-light">Nombre</label>
                            </div>

                            {{-- Correo --}}
                            <div class="md-form">
                                <i class="far fa-envelope prefix grey-text"></i>
                                <input type="email" name="email" id="email" class="form-control"
                                       value="{{ old('email') }}">
                                <label for="email" class="font-weight-light">Correo electronico</label>
                            </div>


                            {{-- Foto de perfil --}}
                            <div style="margin: 40px 0">
                                <div class="form-group">
                                    <label for="image">Foto de perfil</label>
                                    <input type="file" name="image" id="image" class="form-control-file"
                                           @change="onFileSelected" value="">
                                </div>

                                <figure>
                                    <img width="200" height="200"
                                         :src="imagen == '' ? '{{ asset("img/player-default.jpg") }}' : imagen"
                                         alt="Foto perfil de usuario">
                                </figure>
                            </div>

                            {{-- Contraseña --}}
                            <div class="md-form">
                                <i class="fas fa-key prefix grey-text"></i>
                                <input type="password" name="password" id="password" class="form-control">
                                <label for="password" class="font-weight-light">Contraseña</label>
                            </div>


                            {{--Repetir contraseña--}}
                            <div class="md-form">
                                <i class="fas fa-key prefix grey-text"></i>
                                <input type="password" name="password_verify" id="password_verify" class="form-control">
                                <label for="password_verify" class="font-weight-light">Repetir Contraseña</label>
                            </div>


                            {{-- Boton registrar --}}
                            <div class="form-group text-center">
                                <button class="btn light-blue my-4" type="submit">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
