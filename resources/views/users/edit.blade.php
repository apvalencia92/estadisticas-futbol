@extends('admin.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header light-blue white-text text-center py-4">
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


                        <form method="post" action="{{ route('usuarios.update',$usuario) }}"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="md-form">
                                <i class="fas fa-user-alt prefix active"></i>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ old('name', $usuario->name) }}">
                                <label for="name" class="font-weight-light">Nombre</label>
                            </div>

                            <div class="md-form">
                                <i class="far fa-envelope prefix active"></i>
                                <input type="email" name="email" id="email" class="form-control"
                                       value="{{ old('email',$usuario->email) }}">
                                <label class="font-weight-light" for="email">Correo electronico</label>
                            </div>

                            <!--================================================
                                         Foto de perfil
                            ================================================!-->
                            <div style="margin: 40px 0">
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
                            </div>

                            <div class="md-form">
                                <i class="fas fa-key prefix grey-text"></i>
                                <input type="password" name="password" id="password" class="form-control">
                                <label for="password" class="font-weight-light">Contraseña</label>
                            </div>

                            <div class="md-form">
                                <i class="fas fa-key prefix grey-text"></i>
                                <input type="password" name="password-confirm" id="password-confirm" class="form-control">
                                <label for="password-confirm" class="font-weight-light">Repetir contraseña</label>
                            </div>


                            <div class="form-group text-center">
                                <input type="submit" value="Actualizar" class="btn light-blue">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
