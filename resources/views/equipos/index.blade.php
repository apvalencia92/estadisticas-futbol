@extends('admin.app')
@section('title','Listado de equipos')
@section('pagina_actual','Listado de equipos')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Listado de equipos</strong>
                    </h5>

                    <div class="card-body">

                            <table class="table table-bordered text-center">

                                <thead>
                                <tr>
                                    <th>Nombre del equipo</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($equipos as $equipo)
                                    <tr>
                                        <td>{{ $equipo->name }}</td>
                                        <td>
                                            <form action="" method="post">
                                                @csrf
                                                @method('delete')
                                                <a class="btn btn-primary" href="">Ver más</a>
                                                <a class="btn btn-mdb-color" href="">Editar</a>
                                                <input class="btn btn-danger m-0" type="submit" value="Eliminar">
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>

                            {{--{{ $equipos->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
