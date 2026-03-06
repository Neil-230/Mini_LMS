@extends('layouts.app')

@section('content')
<!-- Add Google Fonts for consistency with the Home page -->
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
    .login-bg {
        /* background: var(--primary-gradient); */
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .login-bg::before {
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
    .btn-login {
        background: var(--primary-gradient);
        border: none;
        padding: 0.8rem;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
        color: white;
    }

    /* Demo Box */
    .demo-box {
        background: rgba(255, 255, 255, 0.56);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 1rem;
        color: black;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        margin-top: 1.5rem;
    }
    
    .demo-box code {
        background: rgba(0, 0, 0, 0.2);
        padding: 2px 6px;
        border-radius: 4px;
        font-family: monospace;
        color: #fff;
    }

    /* Validation Errors */
    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }
</style>

<div class="login-bg d-flex align-items-center justify-content-center py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-6">
                
                <!-- Glass Card -->
                <div class="glass-card p-4 p-md-5">
                    <!-- Logo / Header -->
                    <div class="text-center mb-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 rounded-circle mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-book-reader text-primary fa-2x"></i>
                        </div>
                        <h2 class="fw-bold mb-1">Welcome Back</h2>
                        <p class="text-muted small">Sign in to access the Library System</p>
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

                    <form method="POST" action="{{ route('login.store') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" 
                                       type="email" name="email" value="{{ old('email') }}" 
                                       required autofocus autocomplete="username" placeholder="name@example.com">
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
                                       type="password" name="password" required autocomplete="current-password" 
                                       placeholder="••••••••">
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label small text-muted" for="remember_me">
                                    Remember me
                                </label>
                            </div>
                            <a href="#" class="small text-decoration-none text-primary fw-bold">
                                Forgot Password?
                            </a>
                        </div>

                        <!-- Login Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-login text-white shadow">
                                <i class="fas fa-sign-in-alt me-2"></i> Sign In
                            </button>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center mt-4">
                            <p class="text-muted small">Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-bold text-primary">
                                    Register here
                                </a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Demo Credentials (Visible only if not logged in, styled nicely) -->
                <div class="demo-box text-center">
                    <div class="small fw-bold mb-2"><i class="fas fa-key me-1"></i> Demo Access</div>
                    <div class="d-flex justify-content-between align-items-center small">
                        <span>Email:</span>
                        <code>librarian@librarysystem.local</code>
                    </div>
                    <div class="d-flex justify-content-between align-items-center small mt-1">
                        <span>Password:</span>
                        <code>password123</code>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection