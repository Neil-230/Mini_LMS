@extends('layouts.app')

@section('title', 'Borrowing Details')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="breadcrumb">
                <a href="{{ route('borrowings.index') }}" class="breadcrumb-item">Borrowings</a>
                <span class="breadcrumb-item active">Details</span>
            </div>
            <h1 class="page-title">
                <i class="fas fa-file-invoice"></i> Borrowing Details
            </h1>
        </div>
        <div class="col-md-4 text-end">
            @if($borrowing->status !== 'returned')
                <a href="{{ route('borrowings.return', $borrowing) }}" class="btn btn-success btn-icon">
                    <i class="fas fa-undo"></i> Return Books
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Student Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Name</label>
                        <p class="mb-0">
                            <strong>
                                <a href="{{ route('students.show', $borrowing->student) }}">
                                    {{ $borrowing->student->name }}
                                </a>
                            </strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Student ID</label>
                        <p class="mb-0"><strong>{{ $borrowing->student->student_id }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Email</label>
                        <p class="mb-0"><strong>{{ $borrowing->student->email }}</strong></p>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small">Phone</label>
                        <p class="mb-0"><strong>{{ $borrowing->student->phone ?? 'N/A' }}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-book"></i> Book Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Title</label>
                        <p class="mb-0">
                            <strong>
                                <a href="{{ route('books.show', $borrowing->book) }}">
                                    {{ $borrowing->book->title }}
                                </a>
                            </strong>
                        </p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">ISBN</label>
                        <p class="mb-0"><strong>{{ $borrowing->book->isbn }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Publisher</label>
                        <p class="mb-0"><strong>{{ $borrowing->book->publisher ?? 'N/A' }}</strong></p>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small">Authors</label>
                        <p class="mb-0">
                            @forelse($borrowing->book->authors as $author)
                                <span class="badge bg-info">{{ $author->name }}</span>
                            @empty
                                <span class="text-muted">No authors</span>
                            @endforelse
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt"></i> Transaction Details</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Quantity</label>
                                <p class="mb-0"><strong>{{ $borrowing->quantity }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Returned Quantity</label>
                                <p class="mb-0"><strong>{{ $borrowing->returned_quantity }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Outstanding Quantity</label>
                                <p class="mb-0">
                                    <strong>{{ $borrowing->quantity - $borrowing->returned_quantity }}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Status</label>
                                <p class="mb-0">
                                    @if($borrowing->status === 'borrowed')
                                        <span class="badge bg-primary">Borrowed</span>
                                    @elseif($borrowing->status === 'partially_returned')
                                        <span class="badge bg-warning">Partially Returned</span>
                                    @else
                                        <span class="badge bg-success">Returned</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Borrow Date</label>
                                <p class="mb-0"><strong>{{ $borrowing->borrow_date->format('M d, Y') }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Due Date</label>
                                <p class="mb-0"><strong>{{ $borrowing->due_date->format('M d, Y') }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Return Date</label>
                                <p class="mb-0"><strong>{{ $borrowing->return_date ? $borrowing->return_date->format('M d, Y') : 'N/A' }}</strong></p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="text-muted small">Overdue Days</label>
                                <p class="mb-0">
                                    @php
                                        $overdueDays = $borrowing->getOverdueDays();
                                    @endphp
                                    @if($overdueDays > 0)
                                        <span class="badge bg-danger">{{ $overdueDays }} days</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-dollar-sign"></i> Fine Information</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Fine Calculation:</strong> ₱10 × Overdue Days × Outstanding Books
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body text-center">
                                    <p class="text-muted small mb-2">Total Fine Amount</p>
                                    @php
                                        $fine = $borrowing->calculateFine();
                                    @endphp
                                    <p class="display-6 text-danger mb-0">
                                        <strong>₱{{ number_format($fine, 2) }}</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <p class="text-muted small mb-1"><strong>Calculation Details:</strong></p>
                                    <ul class="small mb-0">
                                        <li>Overdue Days: <strong>{{ $overdueDays }}</strong></li>
                                        <li>Outstanding Books: <strong>{{ $borrowing->quantity - $borrowing->returned_quantity }}</strong></li>
                                        <li>Fine Rate: <strong>₱10/day/book</strong></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
