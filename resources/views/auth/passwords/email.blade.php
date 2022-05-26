<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form id="forgot-password-form" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input name="email" type="email" class="form-control" id="email">
                        <small class="text-danger error_msg"></small>
                    </div>

                    <a href="javascript:void(0)" onclick="$('#forgot-password-modal').submit()">
                        <h4 class="feature-items_shop modal-login-btn">Send Password Reset Link</h4>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>

@include('auth.auth-script', ['form' => 'forgot-password-form', 'modal_id' => 'forgotPasswordModal']) {{-- form = id --}}

