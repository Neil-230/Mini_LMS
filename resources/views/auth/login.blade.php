@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-secondary) 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4 fw-bold">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </h2>
                        
                        <!-- Session Status -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login.store') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" 
                                       type="email" name="email" value="{{ old('email') }}" 
                                       required autofocus autocomplete="username" placeholder="Enter your email">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror"
                                       type="password" name="password" required autocomplete="current-password" 
                                       placeholder="Enter your password">
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Remember Me -->
                            <div class="mb-4 form-check">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label" for="remember_me">
                                    {{ __('Remember me') }}
                                </label>
                            </div>

                            <!-- Login Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                    <i class="fas fa-sign-in-alt"></i> Login
                                </button>
                            </div>

                            <!-- Register Link -->
                            <div class="text-center mt-4">
                                <p class="text-muted">Don't have an account? 
                                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold">
                                        Register here
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Demo Credentials -->
                <div class="alert alert-info mt-4">
                    <strong><i class="fas fa-info-circle"></i> Demo Credentials:</strong>
                    <br>Email: <code>librarian@librarysystem.local</code>
                    <br>Password: <code>password123</code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
