@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="page-title">
                <i class="fas fa-chart-line"></i> Dashboard
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="fas fa-book fa-3x text-primary mb-3"></i>
                <div class="card-number">{{ $totalBooks }}</div>
                <div class="card-label">Total Books</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="fas fa-user-graduate fa-3x text-success mb-3"></i>
                <div class="card-number">{{ $totalStudents }}</div>
                <div class="card-label">Total Students</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="fas fa-pen-fancy fa-3x text-info mb-3"></i>
                <div class="card-number">{{ $totalAuthors }}</div>
                <div class="card-label">Total Authors</div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="dashboard-card">
                <i class="fas fa-exchange-alt fa-3x text-warning mb-3"></i>
                <div class="card-number">{{ $activeBorrowings }}</div>
                <div class="card-label">Active Borrowings</div>
            </div>
        </div>
    </div>

    @if($overdueBooks->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-danger">
                    <div class="card-header bg-danger">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle"></i> Overdue Books Alert
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Book Title</th>
                                        <th>Due Date</th>
                                        <th>Overdue Days</th>
                                        <th>Fine Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($overdueBooks as $borrowing)
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
                                            <td>{{ $borrowing->due_date->format('M d, Y') }}</td>
                                            <td>
                                                <span class="badge badge-danger">{{ $borrowing->getOverdueDays() }} days</span>
                                            </td>
                                            <td>
                                                <strong>₱{{ number_format($borrowing->calculateFine(), 2) }}</strong>
                                            </td>
                                            <td>
                                                <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-sm btn-info btn-icon">
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

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('students.create') }}" class="btn btn-primary btn-icon w-100 mb-2">
                        <i class="fas fa-user-plus"></i> Add New Student
                    </a>
                    <a href="{{ route('books.create') }}" class="btn btn-primary btn-icon w-100 mb-2">
                        <i class="fas fa-book-plus"></i> Add New Book
                    </a>
                    <a href="{{ route('authors.create') }}" class="btn btn-primary btn-icon w-100 mb-2">
                        <i class="fas fa-user-tie"></i> Add New Author
                    </a>
                    <a href="{{ route('borrowings.create') }}" class="btn btn-primary btn-icon w-100">
                        <i class="fas fa-plus-square"></i> Create New Borrowing
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-link"></i> Quick Links</h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('students.index') }}" class="btn btn-outline-primary btn-icon w-100 mb-2">
                        <i class="fas fa-graduation-cap"></i> Manage Students
                    </a>
                    <a href="{{ route('books.index') }}" class="btn btn-outline-primary btn-icon w-100 mb-2">
                        <i class="fas fa-books"></i> Manage Books
                    </a>
                    <a href="{{ route('authors.index') }}" class="btn btn-outline-primary btn-icon w-100 mb-2">
                        <i class="fas fa-pen-fancy"></i> Manage Authors
                    </a>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-outline-primary btn-icon w-100">
                        <i class="fas fa-exchange-alt"></i> View All Borrowings
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
