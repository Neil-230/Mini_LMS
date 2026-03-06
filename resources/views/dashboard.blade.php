@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Add Google Fonts for consistency -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.3);
        --input-bg: #f8f9fa;
        --hover-bg: rgba(79, 70, 229, 0.05);
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
    }

    /* Page Container */
    .page-container {
        min-height: 100vh;
        padding: 2rem 0;
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

    /* Page Title */
    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 0.95rem;
    }

    /* Stats Cards */
    .stat-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        padding: 2rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.45);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--primary-gradient);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1e293b;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.95rem;
        font-weight: 500;
    }

    /* Overdue Panel */
    .overdue-panel {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        overflow: hidden;
    }

    .overdue-header {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .table-custom {
        margin-bottom: 0;
    }

    .table-custom thead th {
        background: rgba(79, 70, 229, 0.05);
        color: #4f46e5;
        font-weight: 600;
        border-bottom: 2px solid rgba(79, 70, 229, 0.1);
        padding: 1rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table-custom tbody td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e2e8f0;
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    .table-custom tbody tr:hover {
        background: var(--hover-bg);
    }

    /* Action Cards */
    .action-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        height: 100%;
        transition: all 0.3s ease;
    }

    .action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 40px 0 rgba(31, 38, 135, 0.45);
    }

    .action-header {
        /* background: var(--primary-gradient); */
        color: black;
        padding: 1.5rem 2rem;
        border-radius: 24px 24px 0 0;
    }

    .action-header h5 {
        color: black;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .action-body {
        padding: 2rem;
    }

    .btn-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        margin-bottom: 0.75rem;
        border: none;
    }

    .btn-action:hover {
        transform: translateX(5px);
    }

    .btn-primary-action {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .btn-primary-action:hover {
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        color: white;
    }

    .btn-outline-action {
        background: white;
        color: #4f46e5;
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .btn-outline-action:hover {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
        border-color: #4f46e5;
    }

    /* Badges */
    .badge {
        padding: 0.4rem 0.8rem;
        font-weight: 500;
        border-radius: 8px;
        font-size: 0.75rem;
    }

    .badge-danger {
        background-color: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* View Button */
    .btn-info {
        background: rgba(56, 189, 248, 0.1);
        color: #0ea5e9;
        padding: 0.5rem 0.8rem;
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        background: #0ea5e9;
        color: white;
        transform: translateY(-2px);
    }
</style>

<div class="page-container">
    <div class="container">
        
        <!-- Page Title -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="page-title">
                    <i class="fas fa-chart-line me-2" style="color: #4f46e5;"></i> Dashboard Overview
                </h1>
                <p class="page-subtitle">Welcome back! Here's what's happening in your library system.</p>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="glass-card stat-card">
                    <div class="stat-icon" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5;">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="stat-number">{{ $totalBooks }}</div>
                    <div class="stat-label">Total Books</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="glass-card stat-card">
                    <div class="stat-icon" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-number">{{ $totalStudents }}</div>
                    <div class="stat-label">Total Students</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="glass-card stat-card">
                    <div class="stat-icon" style="background: rgba(56, 189, 248, 0.1); color: #0ea5e9;">
                        <i class="fas fa-pen-fancy"></i>
                    </div>
                    <div class="stat-number">{{ $totalAuthors }}</div>
                    <div class="stat-label">Total Authors</div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="glass-card stat-card">
                    <div class="stat-icon" style="background: rgba(245, 158, 11, 0.1); color: #f59e0b;">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <div class="stat-number">{{ $activeBorrowings }}</div>
                    <div class="stat-label">Active Borrowings</div>
                </div>
            </div>
        </div>

        <!-- Overdue Alert Section -->
        @if($overdueBooks->count() > 0)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="glass-card overdue-panel">
                        <div class="overdue-header">
                            <i class="fas fa-exclamation-triangle fa-lg"></i>
                            <h5 class="mb-0">Overdue Books Alert</h5>
                            <span class="badge bg-white text-danger ms-auto">{{ $overdueBooks->count() }} Items</span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-custom table-hover">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Book Title</th>
                                            <th>Due Date</th>
                                            <th>Overdue</th>
                                            <th>Fine</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($overdueBooks as $borrowing)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('students.show', $borrowing->student) }}" class="text-decoration-none fw-bold text-dark">
                                                        {{ $borrowing->student->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="{{ route('books.show', $borrowing->book) }}" class="text-decoration-none text-primary">
                                                        {{ $borrowing->book->title }}
                                                    </a>
                                                </td>
                                                <td>{{ $borrowing->due_date->format('M d, Y') }}</td>
                                                <td>
                                                    <span class="badge badge-danger">
                                                        {{ $borrowing->getOverdueDays() }} days
                                                    </span>
                                                </td>
                                                <td>
                                                    <strong class="text-danger">₱{{ number_format($borrowing->calculateFine(), 2) }}</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-info">
                                                        <i class="fas fa-eye"></i> View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Quick Actions & Links -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="glass-card action-card">
                    <div class="action-header">
                        <h5 class="mb-0"><i class="fas fa-plus-circle me-2"></i> Quick Actions</h5>
                    </div>
                    <div class="action-body">
                        <a href="{{ route('students.create') }}" class="btn btn-action btn-primary-action">
                            <i class="fas fa-user-plus"></i> Add New Student
                        </a>
                        <a href="{{ route('books.create') }}" class="btn btn-action btn-primary-action">
                            <i class="fas fa-book-plus"></i> Add New Book
                        </a>
                        <a href="{{ route('authors.create') }}" class="btn btn-action btn-primary-action">
                            <i class="fas fa-user-tie"></i> Add New Author
                        </a>
                        <a href="{{ route('borrowings.create') }}" class="btn btn-action btn-primary-action">
                            <i class="fas fa-exchange-alt"></i> Process Borrowing
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="glass-card action-card">
                    <div class="action-header">
                        <h5 class="mb-0"><i class="fas fa-link me-2"></i> Quick Links</h5>
                    </div>
                    <div class="action-body">
                        <a href="{{ route('students.index') }}" class="btn btn-action btn-outline-action">
                            <i class="fas fa-graduation-cap"></i> Manage Students
                        </a>
                        <a href="{{ route('books.index') }}" class="btn btn-action btn-outline-action">
                            <i class="fas fa-book"></i> Manage Books
                        </a>
                        <a href="{{ route('authors.index') }}" class="btn btn-action btn-outline-action">
                            <i class="fas fa-pen-fancy"></i> Manage Authors
                        </a>
                        <a href="{{ route('borrowings.index') }}" class="btn btn-action btn-outline-action">
                            <i class="fas fa-history"></i> View All Transactions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection