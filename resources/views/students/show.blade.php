@extends('layouts.app')

@section('title', $student->name)

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

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 1rem;
    }

    .breadcrumb-item a {
        color: #4f46e5;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .breadcrumb-item a:hover {
        color: #06b6d4;
    }

    .breadcrumb-item.active {
        color: #64748b;
        font-weight: 600;
    }

    /* Action Buttons */
    .btn-icon {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
    }

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-edit:hover {
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        color: white;
    }

    /* Info Card */
    .info-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        height: 100%;
    }

    .info-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 24px 24px 0 0;
    }

    .info-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .info-body {
        padding: 2rem;
    }

    .info-item {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .info-value {
        color: #1e293b;
        font-size: 1rem;
        font-weight: 600;
    }

    /* Table Styling */
    .table-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        overflow: hidden;
    }

    .table-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 24px 24px 0 0;
    }

    .table-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
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

    .table-custom tbody tr:hover {
        background: var(--hover-bg);
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .badge {
        padding: 0.4rem 0.8rem;
        font-weight: 500;
        border-radius: 8px;
        font-size: 0.75rem;
    }

    .badge-primary {
        background-color: rgba(79, 70, 229, 0.15);
        color: #4f46e5;
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .badge-warning {
        background-color: rgba(245, 158, 11, 0.15);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .badge-success {
        background-color: rgba(16, 185, 129, 0.15);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-danger {
        background-color: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #64748b;
    }

    .empty-state i {
        font-size: 3rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    /* Pagination */
    .pagination {
        margin-top: 2rem;
    }

    .page-link {
        border: none;
        color: #4f46e5;
        margin: 0 0.25rem;
        border-radius: 10px !important;
        transition: all 0.3s ease;
    }

    .page-item.active .page-link {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .page-link:hover {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
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

    /* Student Avatar */
    .student-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
    }
</style>

<div class="page-container">
    <div class="container">
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('students.index') }}">
                                <i class="fas fa-arrow-left me-1"></i> Students
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-user-circle me-1"></i> {{ $student->name }}
                        </li>
                    </ol>
                </nav>
                <h1 class="page-title">
                    <i class="fas fa-user-circle me-2" style="color: #4f46e5;"></i> {{ $student->name }}
                </h1>
                <p class="page-subtitle">Student ID: {{ $student->student_id }}</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('students.edit', $student) }}" class="btn btn-icon btn-edit">
                    <i class="fas fa-edit me-2"></i> Edit
                </a>
                <form method="POST" action="{{ route('students.destroy', $student) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-icon btn-delete">
                        <i class="fas fa-trash me-2"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <!-- Student Information -->
            <div class="col-md-4">
                <div class="glass-card info-card">
                    <div class="info-header">
                        <h5><i class="fas fa-info-circle me-2"></i> Student Information</h5>
                    </div>
                    <div class="info-body">
                        <!-- Avatar -->
                        <div class="student-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Student ID</div>
                            <div class="info-value">{{ $student->student_id }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Email Address</div>
                            <div class="info-value">{{ $student->email }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Phone Number</div>
                            <div class="info-value">{{ $student->phone ?? 'N/A' }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Address</div>
                            <div class="info-value">{{ $student->address ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Borrowing History -->
            <div class="col-md-8">
                <div class="glass-card table-card">
                    <div class="table-header">
                        <h5><i class="fas fa-exchange-alt me-2"></i> Borrowing History</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-custom table-hover">
                                <thead>
                                    <tr>
                                        <th>Book Title</th>
                                        <th>Qty</th>
                                        <th>Borrow Date</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Fine</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($borrowings as $borrowing)
                                        <tr>
                                            <td>
                                                <a href="{{ route('books.show', $borrowing->book) }}" class="text-decoration-none fw-bold text-dark">
                                                    {{ $borrowing->book->title }}
                                                </a>
                                            </td>
                                            <td>{{ $borrowing->quantity }}</td>
                                            <td>{{ $borrowing->borrow_date->format('M d, Y') }}</td>
                                            <td>{{ $borrowing->due_date->format('M d, Y') }}</td>
                                            <td>
                                                @if($borrowing->status === 'borrowed')
                                                    <span class="badge badge-primary">Borrowed</span>
                                                @elseif($borrowing->status === 'partially_returned')
                                                    <span class="badge badge-warning">Partially Returned</span>
                                                @else
                                                    <span class="badge badge-success">Returned</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $fine = $borrowing->calculateFine();
                                                @endphp
                                                @if($fine > 0)
                                                    <span class="badge badge-danger">₱{{ number_format($fine, 2) }}</span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-info">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="empty-state">
                                                    <i class="fas fa-book-open"></i>
                                                    <p class="mb-0">No borrowing records found for this student</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($borrowings->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $borrowings->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection