@extends('layouts.app')

@section('content')
<!-- Content area -->
<div class="content d-flex justify-content-center align-items-center">
    <!-- Login form -->
    <form class="login-form" action="{{ route('password.update') }}" method="post" id="content_form">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1 user_icon"></i>
                    <h5 class="mb-0">Reset Your Password</h5>
                    <span class="d-block text-muted">Enter your credentials here</span>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required autocomplete="email" autofocus  value="{{ $email ?? '' }}">
                    <div class="form-control-feedback">
                        <i class="icon-user text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" name="password" id="password" required autocomplete="current-password" placeholder="Password" minlength="8">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-left">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" data-parsley-equalto="#password" minlength="8">
                    <div class="form-control-feedback">
                        <i class="icon-lock2 text-muted"></i>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn bg-blue btn-block" id="submit"><i class="icon-spinner11 mr-2 user_icon"></i> Reset password</button>
                </div>
            </div>
        </div>
    </form>
    <!-- /login form -->
</div>
<!-- /content area -->
@endsection

@push('scripts')
<script src="{{ asset('js/pages/auth/reset_password.js') }}"></script>
@endpush
