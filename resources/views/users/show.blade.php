@extends('admin.app')
@section('title','Perfil')
@section('pagina_actual','Perfil')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">


                <div class="card card-info card-outline">

                    <div class="card-body box-profile">

                        @if(session('edited'))
                            <div class="alert alert-success" role="alert">
                                <p class="lead">{{ session('edited') }}</p>
                            </div>
                        @endif
                        @if(session('updateprofile'))
                            <article class="alert alert-success text-center text-white p-2">
                                <p class="lead m-0">{{ session('updateprofile') }}</p>
                            </article>
                        @endif


                        <div class="text-center">
                            <img src="{{ $image }}" class="profile-user-img img-fluid img-circle" alt="Foto de perfil">
                        </div>
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center">Informacion del usuario</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Equipo</b> <a class="float-right">{{ $user->equipos()->value('name') }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Rol</b><a class="float-right">{{ $user->roles->pluck('name')->implode(' - ') }}</a>
                            </li>
                        </ul>
                        <div class="form-group">
                            @listusuarios
                            <a href="{{ route('usuarios.edit',$user) }}" class="btn btn-info btn-md">Editar Perfil</a>
                            @crearespectador
                            <a href="{{ route('usuarios.create') }}" class="btn btn-secondary btn-md">Registrar
                                Espectador</a>
                            @endcrearespectador
                            <a href="{{ route('usuarios.index') }}" class="btn btn-primary btn-md">Ver Espectadores</a>

                            @else
                                <div class="text-left">
                                    <a href="" class="btn btn-info btn-rounded mb-4" data-toggle="modal"
                                       data-target="#modalFotoPerfil">Actualizar foto de perfil</a>
                                </div>
                            @endlistusuarios
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


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