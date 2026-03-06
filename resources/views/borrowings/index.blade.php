@extends('layouts.app')

@section('title', 'Borrowing Transactions')

@section('content')
<!-- Add Google Fonts for consistency -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet">

<style>
    /* Import styles from your layout to ensure consistency */
    body {
        font-family: 'Inter', sans-serif;
    }
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Poppins', sans-serif;
    }

    /* Page Title */
    .page-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Action Button */
    .btn-icon {
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.4);
        color: white;
    }

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .table-custom {
        margin-bottom: 0;
    }

    .table-custom thead th {
        background-color: #f8f9fa;
        color: var(--primary-color);
        font-weight: 600;
        border-bottom: 2px solid #e9ecef;
        padding: 15px;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table-custom tbody td {
        padding: 15px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f1;
    }

    .table-custom tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Badges */
    .badge {
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 6px;
        font-size: 0.8rem;
    }

    .badge-primary {
        background-color: rgba(79, 70, 229, 0.15);
        color: var(--primary-color);
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .badge-warning {
        background-color: rgba(243, 156, 18, 0.15);
        color: #d68910;
        border: 1px solid rgba(243, 156, 18, 0.2);
    }

    .badge-success {
        background-color: rgba(39, 174, 96, 0.15);
        color: var(--success-color);
        border: 1px solid rgba(39, 174, 96, 0.2);
    }

    .badge-danger {
        background-color: rgba(231, 76, 60, 0.15);
        color: var(--danger-color);
        border: 1px solid rgba(231, 76, 60, 0.2);
    }

    /* Links */
    .table-custom tbody td a {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .table-custom tbody td a:hover {
        color: var(--primary-color);
    }

    /* View Button */
    .btn-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        border: none;
        transition: all 0.3s;
    }

    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(23, 162, 184, 0.3);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 3rem;
        color: #bdc3c7;
        margin-bottom: 15px;
    }

    .empty-state a {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 600;
    }

    .empty-state a:hover {
        color: var(--primary-color);
    }

    /* Pagination */
    .pagination {
        margin-top: 20px;
    }

    .page-link {
        border: none;
        color: var(--primary-color);
        margin: 0 5px;
        border-radius: 8px !important;
        transition: all 0.3s;
    }

    .page-item.active .page-link {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
    }

    .page-link:hover {
        background: var(--secondary-color);
        color: white;
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="page-title">
                <i class="fas fa-exchange-alt text-primary"></i> Borrowing Transactions
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('borrowings.create') }}" class="btn btn-primary btn-icon">
                <i class="fas fa-plus-square me-2"></i> New Borrowing
            </a>
        </div>
    </div>

    <!-- Table Card -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-custom table-hover">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Book</th>
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
                                <a href="{{ route('students.show', $borrowing->student) }}">
                                    {{ $borrowing->student->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('books.show', $borrowing->book) }}">
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
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p class="mb-0">No borrowings found. <a href="{{ route('borrowings.create') }}">Create one now!</a></p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($borrowings->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $borrowings->links() }}
            </div>
        @endif
    </div>
</div>
@endsection