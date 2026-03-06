@extends('layouts.app')

@section('content')
<!-- Add Google Fonts for consistency with the Login page -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.3);
        --input-bg: #f8f9fa;
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
    }

    /* Background Animation */
    .register-bg {
        background: none;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .register-bg::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Glass Card */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        position: relative;
        z-index: 10;
    }

    /* Form Inputs */
    .form-control {
        background-color: var(--input-bg);
        border: 1px solid #e2e8f0;
        padding: 0.8rem 1rem;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    .input-group-text {
        background-color: transparent;
        border: none;
        color: #64748b;
    }

    .input-group:focus-within .input-group-text {
        color: #4f46e5;
    }

    /* Button */
    .btn-register {
        background: var(--primary-gradient);
        border: none;
        padding: 0.8rem;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        color: white;
    }

    /* Validation Errors */
    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    /* Password Strength Indicator */
    .password-strength {
        height: 4px;
        border-radius: 2px;
        margin-top: 0.5rem;
        background: #e2e8f0;
        overflow: hidden;
    }

    .password-strength-bar {
        height: 100%;
        width: 0%;
        transition: width 0.3s ease, background-color 0.3s ease;
    }

    .password-strength.weak .password-strength-bar {
        width: 33%;
        background-color: #ef4444;
    }

    .password-strength.medium .password-strength-bar {
        width: 66%;
        background-color: #f59e0b;
    }

    .password-strength.strong .password-strength-bar {
        width: 100%;
        background-color: #10b981;
    }
</style>

<div class="register-bg d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6">
                
                <!-- Glass Card -->
                <div class="glass-card p-4 p-md-5">
                    <!-- Logo / Header -->
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-user-plus text-primary fa-2x"></i>
                        </div>
                        <h2 class="fw-bold mb-1">Create Account</h2>
                        <p class="text-muted small">Join the Library System today</p>
                    </div>

                    <!-- Session Status -->
                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm border-0 mb-4" role="alert">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <div>
                                    @foreach ($errors->all() as $error)
                                        <div class="small">{{ $error }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold small text-uppercase text-muted">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="name" class="form-control @error('name') is-invalid @enderror" 
                                       type="text" name="name" value="{{ old('name') }}" 
                                       required autofocus autocomplete="name" placeholder="John Doe">
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" 
                                       type="email" name="email" value="{{ old('email') }}" 
                                       required autocomplete="username" placeholder="name@example.com">
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold small text-uppercase text-muted">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" class="form-control @error('password') is-invalid @enderror"
                                       type="password" name="password" required autocomplete="new-password" 
                                       placeholder="••••••••">
                            </div>
                            <div class="password-strength mt-2" id="password-strength">
                                <div class="password-strength-bar"></div>
                            </div>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle me-1"></i> At least 8 characters with uppercase, lowercase, numbers, and special characters.
                            </small>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-bold small text-uppercase text-muted">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                       type="password" name="password_confirmation" required autocomplete="new-password" 
                                       placeholder="••••••••">
                            </div>
                            @error('password_confirmation')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Register Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-register text-white shadow">
                                <i class="fas fa-user-plus me-2"></i> Create Account
                            </button>
                        </div>

                        <!-- Login Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted small">Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none fw-bold text-primary">
                                    Sign in here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Security Note (Styled Consistently) -->
                <div class="demo-box text-center mt-3">
                    <div class="small fw-bold mb-2"><i class="fas fa-shield-alt me-1"></i> Security First</div>
                    <div class="small text-muted">
                        Your data is encrypted and protected. We never share your information with third parties.
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Password Strength Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const strengthContainer = document.getElementById('password-strength');
        const strengthBar = strengthContainer.querySelector('.password-strength-bar');

        passwordInput.addEventListener('input', function() {
            const value = this.value;
            let strength = 0;

            if (value.length >= 8) strength++;
            if (value.match(/[a-z]/)) strength++;
            if (value.match(/[A-Z]/)) strength++;
            if (value.match(/[0-9]/)) strength++;
            if (value.match(/[^a-zA-Z0-9]/)) strength++;

            strengthContainer.classList.remove('weak', 'medium', 'strong');
            
            if (strength <= 2) {
                strengthContainer.classList.add('weak');
            } else if (strength <= 4) {
                strengthContainer.classList.add('medium');
            } else {
                strengthContainer.classList.add('strong');
            }
        });
    });
</script>
@endsection