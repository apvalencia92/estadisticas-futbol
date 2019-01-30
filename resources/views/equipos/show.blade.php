@extends('admin.app')
@section('title','Perfil')
@section('pagina_actual','Perfil')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">


                <div class="card card-info card-outline">

                    <div class="card-body box-profile">


                        <div class="text-center">
                            <img src="" class="profile-user-img img-fluid img-circle" alt="Foto de perfil">
                        </div>
                        <h3 class="profile-username text-center">{{ $equipo->name }}</h3>
                        <p class="text-muted text-center">Informacion del equipo</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Nombre equipo</b> <a class="float-right">{{ $equipo->name }}</a>
                            </li>
                        </ul>

                    </div>

                </div>
            </div>
        </div>
    </div>




@endsection