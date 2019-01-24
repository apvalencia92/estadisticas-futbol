@extends('admin.app')
@section('title','Registro de usuarios')
@section('pagina_actual','Registro de usuarios')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header info-color white-text text-center py-4">
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
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fas fa-user-alt"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                </div>
                            </div>

                            {{-- Correo --}}
                            <div class="form-group">
                                <label for="email">Correo electronico</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                                </div>
                            </div>



                            {{-- Foto de perfil --}}
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

                            {{-- Contraseña --}}
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>


                            {{--Repetir contraseña--}}
                            <div class="form-group">
                                <label for="password_verify">Repetir contraseña</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i><i class="fas fa-key"></i></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password_verify" id="password_verify" class="form-control">
                                </div>
                            </div>

                            {{-- Boton registrar --}}
                            <div class="form-group text-center">
                                <button class="btn btn-info my-4" type="submit">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
