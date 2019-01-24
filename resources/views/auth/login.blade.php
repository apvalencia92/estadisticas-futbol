@extends('layouts.app')

@section('content')
    <section class="section_guest d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="row justify-content-center py-4">
            <div class="col-md-6">
                <!-- Material form login -->
                <div class="card">

                    <h5 class="card-header info-color white-text text-center py-4">
                        <strong>Inicio de sesión</strong>
                    </h5>

                    <!--Card content-->
                    <div class="card-body px-lg-5 pt-0">

                        <!-- Form -->
                        <form action="{{ route('login') }}" class="text-center" method="POST" style="color: #757575;">
                            @csrf
                            <!-- Email -->
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

                            <!-- Password -->
                            <div class="md-form">
                                <input type="password" id="password" name="password"
                                       class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}">
                                <label for="password">Contraseña</label>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                        </span>
                                @endif
                            </div>

                            <div class="d-flex justify-content-around">
                                <div>
                                    <!-- Remember me -->
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="remeber"
                                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                               for="materialLoginFormRemember">Recuerdame</label>
                                    </div>
                                </div>
                                <div>
                                    <!-- Forgot password -->
                                    <a href="{{ route('password.request') }}">¿ Olvidaste tu contraseña ?</a>
                                </div>
                            </div>

                            <!-- Sign in button -->
                            {{--<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>--}}
                            <button class="btn btn-info btn-block my-4" type="submit">Iniciar sesión</button>
                        <!-- Register -->
                            <p>¿Aun no estas registrado?
                                <a href="{{ url('register') }}">Registrarte</a>
                            </p>


                        </form>
                        <!-- Form -->

                    </div>

                </div>
                <!-- Material form login -->

            </div>
        </div>
    </div>
    </section>
    {{--<!-- /.login-box -->--}}
    {{--<div class="container">--}}
        {{--<div class="row justify-content-center">--}}
            {{--<div class="col-md-8">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">{{ __('Login') }}</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<form method="POST" action="{{ route('login') }}">--}}
                            {{--@csrf--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="email"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="email" type="email"--}}
                                           {{--class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"--}}
                                           {{--name="email" value="{{ old('email') }}" required autofocus>--}}

                                    {{--@if ($errors->has('email'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="password"--}}
                                       {{--class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="password" type="password"--}}
                                           {{--class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"--}}
                                           {{--name="password" required>--}}

                                    {{--@if ($errors->has('password'))--}}
                                        {{--<span class="invalid-feedback" role="alert">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<div class="col-md-6 offset-md-4">--}}
                                    {{--<div class="form-check">--}}
                                        {{--<input class="form-check-input" type="checkbox" name="remember"--}}
                                               {{--id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                                        {{--<label class="form-check-label" for="remember">--}}
                                            {{--{{ __('Remember Me') }}--}}
                                        {{--</label>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row mb-0">--}}
                                {{--<div class="col-md-8 offset-md-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">--}}
                                        {{--{{ __('Login') }}--}}
                                    {{--</button>--}}

                                    {{--@if (Route::has('password.request'))--}}
                                        {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                            {{--{{ __('Forgot Your Password?') }}--}}
                                        {{--</a>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection
