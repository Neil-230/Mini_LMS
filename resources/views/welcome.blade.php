@extends('layouts.app')

@section('content')
<div class="min-vh-100" style="background: linear-gradient(135deg, var(--bs-primary) 0%, var(--bs-secondary) 100%);">
    <!-- Hero Section -->
    <section class="py-5 text-white text-center" style="min-height: 300px; display: flex; align-items: center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h1 class="display-3 fw-bold mb-4">
                        <i class="fas fa-book"></i> Mini Library Management System
                    </h1>
                    <p class="lead mb-4">
                        Your comprehensive solution for managing library collections, student borrowing records, and automated fine calculations.
                    </p>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg me-2">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Key Features</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x mb-3"" style="color: var(--bs-primary);"></i>
                            <h5 class="card-title fw-bold">Student Management</h5>
                            <p class="card-text text-muted">Manage student profiles and borrowing history</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-book-open fa-3x mb-3" style="color: var(--bs-secondary);"></i>
                            <h5 class="card-title fw-bold">Book Catalog</h5>
                            <p class="card-text text-muted">Browse and manage your book collection</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-feather fa-3x mb-3" style="color: #6f42c1;"></i>
                            <h5 class="card-title fw-bold">Authors</h5>
                            <p class="card-text text-muted">Track authors and their publications</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                            <i class="fas fa-exchange-alt fa-3x mb-3" style="color: #17a2b8;"></i>
                            <h5 class="card-title fw-bold">Transactions</h5>
                            <p class="card-text text-muted">Track borrowing, returns & fines</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">How It Works</h2>
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="fw-bold mb-3">For Students:</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Register or login to account
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Browse available books
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Borrow books (14-day default loan period)
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Return books on time
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Pay fines if overdue (₱10/day per book)
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <h4 class="fw-bold mb-3">For Librarians:</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Add and manage books
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Manage author information
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Register new students
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Process borrowing & return transactions
                        </li>
                        <li class="list-group-item border-0">
                            <i class="fas fa-check-circle text-success me-2"></i> Monitor overdue books & fines
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Technology Stack -->
    <section class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Built With Modern Technology</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="badge bg-primary p-3" style="font-size: 14px;">
                        Laravel 12
                    </div>
                    <p class="mt-2 text-muted">Robust PHP Framework</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="badge bg-secondary p-3" style="font-size: 14px;">
                        Bootstrap 5
                    </div>
                    <p class="mt-2 text-muted">Responsive Design</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="badge bg-dark p-3" style="font-size: 14px;">
                        SQL Database
                    </div>
                    <p class="mt-2 text-muted">Reliable Data Storage</p>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="badge bg-info p-3" style="font-size: 14px;">
                        Eloquent ORM
                    </div>
                    <p class="mt-2 text-muted">Database Relationships</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-5 text-white text-center" style="background: linear-gradient(135deg, var(--bs-secondary) 0%, var(--bs-info) 100%);">
        <div class="container">
            <h2 class="fw-bold mb-4">Ready to Get Started?</h2>
            <p class="lead mb-4">Access the library management system and streamline your operations.</p>
            @auth
                <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg">
                    <i class="fas fa-arrow-right"></i> Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2">
                    <i class="fas fa-sign-in-alt"></i> Login Now
                </a>
            @endauth
        </div>
    </section>
</div>
@endsection
