@extends('admin.app')
@section('title','Perfil')
@section('pagina_actual','Perfil')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">


                <div class="card">
                    <h5 class="card-header light-blue white-text text-center py-4">
                        <strong>Informacion del equipo</strong>
                    </h5>

                    <div class="card-body box-profile">
                        @if(session('update'))
                            <div class="alert alert-success text-center" role="alert">
                                <p class="lead m-0">{{ session('update') }}</p>
                            </div>
                        @endif
                        <div class="text-center">
                            <figure>
                                <img width="200" height="200"
                                     src="{{ $image }}"
                                     alt="Logo del equipo">
                            </figure>
                        </div>

                        <h3 class="profile-username text-center py-4">{{ $equipo->name }}</h3>
                        <ul class="list-group list-group-unbordered mb-3 text-center">
                            <li class="list-group-item">
                                <p class="m-0"><b>Nombre equipo </b> {{ $equipo->name }} </p>
                            </li>
                            <li class="list-group-item">
                                <p class="m-0"><b>Fundado</b> {{ $equipo->fecha_nacimiento }} </p>
                            </li>
                        </ul>

                        <div class="form-group text-center">
                            <a href="{{ route('equipos.edit',$equipo) }}" class="btn btn-blue waves-effect waves-light">Editar
                                equipo</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>




@endsection