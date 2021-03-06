@extends('admin.app')
@section('title','Listado de usuarios')
@section('pagina_actual','Listado de usuarios')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <h5 class="card-header light-blue white-text text-center py-4">
                        <strong>Listado de usuarios</strong>
                    </h5>

                    <div class="card-body">
                        @tablausuarios
                            <div class="alert alert-info">
                                <p class="lead">Aun no no tienes registrado ningun espectador</p>
                            </div>

                        @else
                        <table class="table table-bordered text-center">

                            @if(session('created'))
                                <article class="alert alert-success text-center text-white p-2">
                                    <p class="lead m-0">{{ session('created') }}</p>
                                </article>
                            @endif
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    {{--<td> {{ $user->roles->pluck('name')->implode(' - ') }} </td>--}}
                                    <td>
                                        <form action="{{ route('usuarios.destroy', $usuario) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <a class="btn btn-primary" href="{{ route('usuarios.show',$usuario) }}">Ver más</a>
                                            <a class="btn btn-mdb-color" href="{{ route('usuarios.edit',$usuario) }}">Editar</a>
                                            <input class="btn btn-danger m-0" type="submit" value="Eliminar">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>

                        </table>

                        @endtablausuarios


                          @crearespectador
                        <div class="form-group">
                            <a href="{{ route('usuarios.create') }}" class="btn btn-blue waves-effect waves-light my-4">Registrar espectador</a>
                        </div>
                        @endcrearespectador


                        {{--{{ $users->links() }}--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
