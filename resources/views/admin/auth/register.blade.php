@extends('auth.layouts.app')

@push('extra-css')
{{--    <style>--}}
{{--        .list-group.clear-list .list-group-item {--}}
{{--            border-top: none;--}}
{{--        }--}}

{{--        .list-group-item {--}}
{{--            border: none;--}}
{{--        }--}}

{{--        .list-group-item a {--}}
{{--            color: black;--}}
{{--        }--}}

{{--        .list-group-item a:hover {--}}
{{--            text-decoration: underline;--}}
{{--        }--}}
{{--    </style>--}}
@endpush

@section('content')

    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form role="form" method="POST" action="{{ route('register') }}">
                    <div class="input-group mb-3">

                        <input id="name" type="text" required class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="First Name">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>

                        @error('name')
                        <span class="help-block m-b-none text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">

                        <input id="last_name" type="text" required
                               class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                               value="{{ old('last_name') }}" autocomplete="last_name" autofocus placeholder="Last Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('last_name')
                            <span class="help-block m-b-none text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">

                        <input id="email" type="email" required class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('email')
                        <span class="help-block m-b-none text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="phone" type="text" required class="form-control @error('phone') is-invalid @enderror"
                               name="phone" value="{{ old('phone') }}" placeholder="Phone">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>

                        @error('phone')
                            <span class="help-block m-b-none text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" required class="form-control"
                               name="password_confirmation" autocomplete="new-password" placeholder="Confirm-Password">

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>

                <a href="login.html" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        <div class="ibox-content">

            <div style="text-align: center">
                <img alt="image" src="{{ asset('panel/assets/images/logo.png') }}" width="166"/>
            </div>

            <h3 class="font-bold">Registration</h3>
            <form class="m-t" role="form" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <input id="name" type="text" required class="form-control @error('name') is-invalid @enderror"
                           name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="First Name">
                    @error('name')
                    <span class="help-block m-b-none text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="last_name" type="text" required
                           class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                           value="{{ old('last_name') }}" autocomplete="last_name" autofocus placeholder="Last Name">
                    @error('last_name')
                    <span class="help-block m-b-none text-danger">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" required class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Email">
                    @error('email')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="phone" type="text" required class="form-control @error('phone') is-invalid @enderror"
                           name="phone" value="{{ old('phone') }}" placeholder="Phone">
                    @error('phone')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" required
                           class="form-control @error('password') is-invalid @enderror" name="password"
                           autocomplete="new-password" placeholder="Password">
                    @error('password')
                    <span class="help-block m-b-none text-danger">
                       <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" required class="form-control"
                           name="password_confirmation" autocomplete="new-password" placeholder="Confirm-Password">
                </div>

                <button type="submit" class="btn btn-primary block full-width"><strong>Registration</strong></button>
            </form>
        </div>
    </div>
@endsection

@section('custom-js')

@endsection
