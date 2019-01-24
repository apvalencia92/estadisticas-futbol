@extends('admin.app')
{{--@section('title','Inicio')--}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header info-color-dark text-center text-white">
                        <h1 class="lead">BIENVENIDO A <b>ESTADISTICAS FUTBOLISTICAS</b></h1>
                    </div>
                    <div class="card-body">

                        @crearespectador
                        <article>
                            <h2>¿ Que es un espectador ?</h2>
                            <p>Es un usuario que podra ver todas
                                las estadisticas del equipo, pero no puede realizar ninguna
                                modificacion a la informacion que tu has suministrado.
                                Basicamente es un usuario que vas a crear para que los integrantes
                                de tu equipo pueden visualizar las estadisticas del equipo, puedes registrar hasta 3
                                espectadores</p>
                            <a href="{{ route('usuarios.create') }}"
                               class="btn btn-outline-info waves-effect">Registrar</a>
                        </article>
                        @endcrearespectador

                        <hr class="hr-gray">


                        @fotoperfil
                        <div class="text-left">
                            <a href="" class="btn btn-info btn-rounded mb-4" data-toggle="modal"
                               data-target="#modalFotoPerfil">Subir foto de perfil</a>
                        </div>
                        @endfotoperfil


                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                    </div>
                </div>
            </div>


        </div>
    </div>


    <!--================================================
             Formulario actualizar perfil
    ================================================!-->

    <div class="modal fade" id="modalFotoPerfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold">Actualizar foto de perfil</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form method="post" action="{{ route('usuarios.updateimage',$user) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="modal-body mx-3">
                        <div class="form-group">
                            <label for="image">Foto de perfil</label>
                            <input type="file" name="image" id="image" class="form-control-file"
                                   value="{{old('image', $user->image)}}" @change="onFileSelected">
                        </div>

                        <figure>
                            <img width="200" height="200"
                                 :src="imagen == '' ? '{{ asset("{$user->getImage()}") }}' : imagen "
                                 alt="Foto perfil de usuario">
                        </figure>

                    </div>

                    <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" class="btn btn-default">Actualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
