@extends('layouts.app')

@section('title', $book->title)

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="breadcrumb">
                <a href="{{ route('books.index') }}" class="breadcrumb-item">Books</a>
                <span class="breadcrumb-item active">{{ $book->title }}</span>
            </div>
            <h1 class="page-title">
                <i class="fas fa-book-open"></i> {{ $book->title }}
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-icon">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form method="POST" action="{{ route('books.destroy', $book) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-icon">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Book Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">ISBN</label>
                        <p class="mb-0"><strong>{{ $book->isbn }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Publisher</label>
                        <p class="mb-0"><strong>{{ $book->publisher ?? 'N/A' }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Published Year</label>
                        <p class="mb-0"><strong>{{ $book->published_year ?? 'N/A' }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Total Quantity</label>
                        <p class="mb-0"><strong>{{ $book->quantity }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Available Count</label>
                        <p class="mb-0">
                            @if($book->available_count > 0)
                                <span class="badge bg-success">{{ $book->available_count }}</span>
                            @else
                                <span class="badge bg-danger">0</span>
                            @endif
                        </p>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small">Authors</label>
                        <p class="mb-0">
                            @forelse($book->authors as $author)
                                <span class="badge bg-info d-block my-1">{{ $author->name }}</span>
                            @empty
                                <span class="text-muted">No authors assigned</span>
                            @endforelse
                        </p>
                    </div>
                </div>
            </div>

            @if($book->description)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-file-alt"></i> Description</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $book->description }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Borrowing History</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
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
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-3">
                                            No borrowing records found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $borrowings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
