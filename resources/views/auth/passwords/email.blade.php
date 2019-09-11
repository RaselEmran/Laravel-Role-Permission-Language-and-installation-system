@extends('layouts.app')
@section('content')
<!-- Content area -->
<div class="content d-flex justify-content-center align-items-center">
    <!-- Password recovery form -->
    <form class="login-form" method="POST" action="{{ route('password.email') }}" id="content_form">
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-2">
                    <i class="icon-spinner11 icon-2x text-warning border-warning border-3 rounded-round p-3 mb-3 mt-1 user_icon"></i>
                    <h5 class="mb-0">Password recovery</h5>
                    <span class="d-block text-muted">We'll send you instructions in email</span>
                </div>
                <div class="form-group form-group-feedback form-group-feedback-right">
                    <input type="email" class="form-control" placeholder="Your email" required autofocus name="email">
                    <div class="form-control-feedback">
                        <i class="icon-mail5 text-muted"></i>
                    </div>
                </div>
                <button type="submit" class="btn bg-blue btn-block" id="submit"><i class="icon-spinner11 mr-2 user_icon"></i> Reset password</button>
                <div class="text-center">
                    @if (Route::has('login'))
                    <a class="btn btn-link" href="{{ route('login') }}">
                        {{ __('Back To Login') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <!-- /password recovery form -->
</div>
<!-- /content area -->
@endsection
@push('scripts')
<script src="{{ asset('js/pages/auth/forgot_password.js') }}"></script>
@endpush