@extends('layouts.app')

@section('content')
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="reset-password-form" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input name="email" type="email" class="form-control" id="email" value="{{ $email }}">
                            <small class="text-danger error_msg"></small>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control" id="password">
                            <small class="text-danger error_msg"></small>
                        </div>

                        <div class="form-group">
                            <label for="password">Confirm Password</label>
                            <input name="password_confirmation" type="password" class="form-control">
                            <small class="text-danger error_msg"></small>
                        </div>

                        <a href="javascript:void(0)" onclick="$('#reset-password-form').submit()">
                            <h4 class="feature-items_shop modal-login-btn">Reset Password</h4>
                        </a>
                    </form>

                    <div class="text-center">
                        <span class="d-block mt-3">Returning Customer?</span>
                        <a href="javascript:void(0)" data-toggle="modal" data-dismiss="modal" data-target="#loginModal"
                           class="signup-link">
                            Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('auth.auth-script', ['form' => 'reset-password-form', 'modal_id' => 'resetPasswordModal']) {{-- form = id --}}

@endsection

@push('script')
    <script>
        $(function () {
            $('#resetPasswordModal').modal('show')
        })
    </script>
@endpush

