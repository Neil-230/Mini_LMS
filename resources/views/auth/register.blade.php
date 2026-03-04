@extends('layouts.app')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-secondary) 100%);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <h2 class="card-title text-center mb-4 fw-bold">
                            <i class="fas fa-user-plus"></i> Register
                        </h2>
                        
                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>There were some errors with your input:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register.store') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Full Name</label>
                                <input id="name" class="form-control @error('name') is-invalid @enderror" 
                                       type="text" name="name" value="{{ old('name') }}" 
                                       required autofocus autocomplete="name" placeholder="Enter your full name">
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email Address</label>
                                <input id="email" class="form-control @error('email') is-invalid @enderror" 
                                       type="email" name="email" value="{{ old('email') }}" 
                                       required autocomplete="username" placeholder="Enter your email">
                                @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input id="password" class="form-control @error('password') is-invalid @enderror"
                                       type="password" name="password" required autocomplete="new-password" 
                                       placeholder="Enter a strong password">
                                <small class="form-text text-muted">
                                    Password must be at least 8 characters with uppercase, lowercase, numbers, and special characters.
                                </small>
                                @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                                <input id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                       type="password" name="password_confirmation" required autocomplete="new-password" 
                                       placeholder="Re-enter your password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Register Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg fw-bold">
                                    <i class="fas fa-user-plus"></i> Register
                                </button>
                            </div>

                            <!-- Login Link -->
                            <div class="text-center mt-4">
                                <p class="text-muted">Already have an account? 
                                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold">
                                        Login here
                                    </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
