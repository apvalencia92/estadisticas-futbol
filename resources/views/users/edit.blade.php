@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Editar espectador</strong>
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


                        <form method="post" action="{{ route('usuarios.update',$usuario) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="{{ old('name', $usuario->name) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Correo electronico</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control"
                                           value="{{ old('email',$usuario->email) }}">
                                </div>
                            </div>

                            <!--================================================
                                         Foto de perfil
                            ================================================!-->

                            <div class="form-group">
                                <label for="exampleFormControlFile1">Foto de perfil</label>
                                <input type="file" name="image" id="image" class="form-control-file"
                                       value="" @change="onFileSelected">
                            </div>

                            <figure>
                                <img width="200" height="200"
                                     :src="imagen == '' ? '{{ asset("{$usuario->getImage()}") }}' : imagen"
                                     alt="Foto perfil de usuario">
                            </figure>


                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm">Repetir contraseña</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                           <i class="fas fa-key"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password-confirm" id="password-confirm"
                                           class="form-control">
                                </div>
                            </div>


                            <div class="form-group">
                                <input type="submit" value="Actualizar" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
