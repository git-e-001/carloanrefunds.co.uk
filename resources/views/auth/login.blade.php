<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Customer Log in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="login-form" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input name="email" type="email" class="form-control" id="email">
                        <small class="text-danger error_msg"></small>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                        <small class="text-danger error_msg"></small>
                    </div>

                    <div class="d-flex justify-content-end">

                        <!--<div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                        </div>-->

                        <a href="javascript:void(0)" data-toggle="modal" data-dismiss="modal"
                           data-target="#forgotPasswordModal">
                            Lost Password?
                        </a>
                    </div>

                    <a href="javascript:void(0)" onclick="$('#login-form').submit()">
                        <h4 class="feature-items_shop modal-login-btn"> Login</h4>
                    </a>
                </form>

                <div class="text-center">
                    <span class="d-block mt-3">No Account Yet?</span>
                    <a href="javascript:void(0)" data-toggle="modal" data-dismiss="modal" data-target="#signUpModal"
                       class="signup-link">
                        Create An Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('auth.auth-script', ['form' => 'login-form', 'modal_id' => 'loginModal']) {{-- form = id --}}
