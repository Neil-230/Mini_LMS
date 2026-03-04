@extends('layouts.app')

@section('title', 'Borrowing Transactions')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="page-title">
                <i class="fas fa-exchange-alt"></i> Borrowing Transactions
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('borrowings.create') }}" class="btn btn-primary btn-icon">
                <i class="fas fa-plus-square"></i> New Borrowing
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Book Title</th>
                            <th>Quantity</th>
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
                                        <span class="badge bg-primary">Borrowed</span>
                                    @elseif($borrowing->status === 'partially_returned')
                                        <span class="badge bg-warning">Partially Returned</span>
                                    @else
                                        <span class="badge bg-success">Returned</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $fine = $borrowing->calculateFine();
                                    @endphp
                                    @if($fine > 0)
                                        <span class="badge bg-danger">₱{{ number_format($fine, 2) }}</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-sm btn-info btn-icon">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    No borrowings found. <a href="{{ route('borrowings.create') }}">Create one now!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $borrowings->links() }}
            </div>
        </div>
    </div>
@endsection
