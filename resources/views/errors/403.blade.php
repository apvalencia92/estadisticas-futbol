@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                       <div class="alert alert-danger">
                           <h1>Atencion</h1>
                           <p>Upps.... No tienes permiso para ejecutar esta acción</p>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
