@extends('layouts.app')

@section('content')
    <section class="section_guest d-flex justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center py-4">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header info-color white-text text-center py-4">
                            <strong>Formulario de registro</strong>
                        </h5>
                        <div class="card-body px-lg-5 pt-0">
                            <form method="POST" action="{{ route('register') }}" class="text-center"
                                  style="color: #757575;">
                            @csrf

                            <!-- name -->
                                <div class="md-form">
                                    <input type="text" id="name" name="name"
                                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           value="{{ old('name') }}" required>
                                    <label for="name">Nombre</label>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <!-- email -->
                                <div class="md-form">
                                    <input type="email" id="email" name="email"
                                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           value="{{ old('email') }}" required>
                                    <label for="email">Correo electronico</label>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <!-- password -->
                                <div class="md-form">
                                    <input type="password" id="password" name="password"
                                           class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           required>
                                    <label for="password">Contraseña</label>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <!-- password-confirm -->
                                <div class="md-form">
                                    <input type="password" id="password-confirm" name="password-confirm"
                                           class="form-control"
                                           required>
                                    <label for="password-confirm">Repetir Contraseña</label>
                                </div>


                                <!-- name_team -->
                                <div class="md-form">
                                    <input type="text" id="name_team" name="name_team"
                                           class="form-control {{ $errors->has('name_team') ? ' is-invalid' : '' }}"
                                           value="{{ old('name_team') }}" required>
                                    <label for="name_team">Nombre del equipo</label>
                                    @if ($errors->has('name_team'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_team') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <button class="btn btn-info btn-block my-4" type="submit">Registrarse</button>

                                {{--<div class="form-group row mb-0">--}}
                                {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                {{--{{ __('Registrarse') }}--}}
                                {{--</button>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
