@extends('admin.auth.layouts.app')
@section('title', 'Login')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-header text-center">
                <a href="{{ route('home') }}">
                    <img width="100%" src="{{ @$globalSettingInfo->image ? $globalSettingInfo->image()->where('type', 'logo')->first()->url : asset('frontend/assets/images/logo.png') }}">
                </a>
            </div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="admin@test.com" required autocomplete="email" autofocus placeholder="Email"
                        >
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                           <span class="help-block m-b-none text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group mb-3">
                        <input id="password" type="password" value="secret"
                               class="form-control @error('password') is-invalid @enderror" name="password" required
                               autocomplete="current-password" placeholder="Password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('password')
                            <span class="help-block m-b-none text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                        <!-- /.col -->
                        <div class="social-auth-links text-center mt-2 mb-3">
                            <button type="submit" class="btn btn-danger btn-block btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                </form>

                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a class="ctext-danger" href="{{ route('admin.password.request') }}">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
