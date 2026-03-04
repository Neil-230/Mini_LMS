@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h1 class="display-4 fw-bold text-primary mb-4">
                <i class="fas fa-book"></i> Library Management System
            </h1>
            <p class="lead text-muted mb-4">
                A comprehensive system for managing books, students, authors, and borrowing transactions with automated fine computation.
            </p>
            <div class="gap-2 d-flex">
                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg btn-icon">
                    <i class="fas fa-chart-line"></i> Go to Dashboard
                </a>
                <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-lg btn-icon">
                    <i class="fas fa-book"></i> Browse Books
                </a>
            </div>
        </div>
        <div class="col-md-6" style="text-align: center;">
            <i class="fas fa-book-open fa-10x text-primary opacity-25"></i>
        </div>
    </div>

    <hr class="my-5">

    <div class="row mt-5 mb-5">
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-graduation-cap fa-3x text-info mb-3"></i>
                <h6>Student Management</h6>
                <p class="small text-muted">Manage student information and borrowing history</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-book fa-3x text-success mb-3"></i>
                <h6>Books Catalog</h6>
                <p class="small text-muted">Browse available books and track inventory</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-pen-fancy fa-3x text-warning mb-3"></i>
                <h6>Authors</h6>
                <p class="small text-muted">Manage authors and their publications</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <i class="fas fa-exchange-alt fa-3x text-danger mb-3"></i>
                <h6>Borrowing</h6>
                <p class="small text-muted">Track borrowing transactions and fines</p>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12">
            <h3 class="mb-4">Features</h3>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>Student Management</strong> - Add, edit, and manage student information
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>Book Catalog</strong> - Maintain book inventory and details
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>Author Database</strong> - Many-to-many relationship between books and authors
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>Borrowing System</strong> - Track book borrowing and returns
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>Fine Computation</strong> - Automatic ₱10/day/book fine calculation
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>Partial Returns</strong> - Support for partial book returns
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>Responsive Design</strong> - Works on all devices
                        </li>
                        <li class="list-group-item">
                            <i class="fas fa-check text-success"></i> <strong>History Tracking</strong> - Complete borrowing history
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
