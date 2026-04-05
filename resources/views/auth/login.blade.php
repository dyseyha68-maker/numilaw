@extends('layouts.auth')

@section('title', 'Login - NUMiLaw Admin')

@section('content')
<div class="login-page">
    <div class="login-card">
        <div class="login-header">
            <img src="{{ url('/laravel-img/logo.png') }}" alt="NUMiLaw">
            <h2>NUM iLaw Login</h2>
            <p>NUM International Program of Legal Studies</p>
        </div>
        
        <div class="login-body">
            @if(session('error'))
                <div class="alert-custom alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
            
            @if($errors->has('captcha'))
                <div class="alert-custom alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first('captcha') }}</span>
                </div>
            @endif
            
            <form action="{{ route('login.attempt') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" 
                           class="form-control-custom {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="admin@numilaw.edu.kh" 
                           required>
                    @if($errors->has('email'))
                        <span class="text-danger small">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" 
                           class="form-control-custom" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password" 
                           required>
                </div>
                
                @if(session('captcha_required') || ($errors->has('captcha')))
                <div class="form-group captcha-group">
                    <label class="captcha-label">
                        <i class="bi bi-shield-check"></i> Security Check
                    </label>
                    <p class="captcha-question">
                        Please solve: <strong>{{ session('captcha_question') ?: '?' }} = ?</strong>
                    </p>
                    <input type="number" 
                           class="form-control-custom" 
                           name="captcha_answer" 
                           placeholder="Enter your answer" 
                           required 
                           min="0"
                           style="width: 120px;">
                    @if($errors->has('captcha'))
                        <span class="text-danger small">{{ $errors->first('captcha') }}</span>
                    @endif
                </div>
                @endif
                
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Sign In
                </button>
            </form>
            
            <div class="text-center">
                <a href="{{ url('/') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Back to Homepage
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.captcha-group {
    background: #f8fafc;
    padding: 1rem;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    text-align: center;
}
.captcha-label {
    font-weight: 600;
    color: #003A46;
    margin-bottom: 0.5rem;
    display: block;
}
.captcha-label i {
    margin-right: 0.5rem;
}
.captcha-question {
    margin-bottom: 0.75rem;
    color: #475569;
}
.captcha-question strong {
    color: #003A46;
    font-size: 1.1rem;
}
.captcha-group input {
    text-align: center;
}
.captcha-group .text-danger {
    display: block;
    margin-top: 0.5rem;
}
</style>
@endsection
