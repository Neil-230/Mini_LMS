@extends('layouts.app')

@section('title', 'Books')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="page-title">
                <i class="fas fa-books"></i> Books Management
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('books.create') }}" class="btn btn-primary btn-icon">
                <i class="fas fa-book-plus"></i> Add New Book
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Authors</th>
                            <th>Publisher</th>
                            <th>Quantity</th>
                            <th>Available</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($books as $book)
                            <tr>
                                <td><strong>{{ $book->isbn }}</strong></td>
                                <td>{{ $book->title }}</td>
                                <td>
                                    @forelse($book->authors as $author)
                                        <span class="badge bg-info">{{ $author->name }}</span>
                                    @empty
                                        <span class="text-muted">No authors</span>
                                    @endforelse
                                </td>
                                <td>{{ $book->publisher ?? 'N/A' }}</td>
                                <td>{{ $book->quantity }}</td>
                                <td>
                                    @if($book->available_count > 0)
                                        <span class="badge bg-success">{{ $book->available_count }}</span>
                                    @else
                                        <span class="badge bg-danger">0</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info btn-icon">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning btn-icon">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('books.destroy', $book) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    No books found. <a href="{{ route('books.create') }}">Create one now!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>
@endsection
