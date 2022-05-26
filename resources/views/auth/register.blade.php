<div class="modal fade" id="signUpModal" tabindex="-1" aria-labelledby="signUpModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="register-form" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input name="name" type="text" class="form-control" id="name">
                        <small class="text-danger error_msg"></small>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email">
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

                    <!--                    <div class="d-flex justify-content-between">
                                            <div class="form-group form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">Subscribe to our newsletter</label>
                                            </div>
                                        </div>-->

                    <a href="javascript:void(0)" onclick="$('#register-form').submit()">
                        <h4 class="feature-items_shop modal-login-btn">Sign Up</h4>
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

@include('auth.auth-script', ['form' => 'register-form', 'modal_id' => 'signUpModal']) {{-- form = id --}}
