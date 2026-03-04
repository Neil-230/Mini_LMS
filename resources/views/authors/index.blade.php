@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="page-title">
                <i class="fas fa-pen-fancy"></i> Authors Management
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('authors.create') }}" class="btn btn-primary btn-icon">
                <i class="fas fa-user-plus"></i> Add New Author
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Books</th>
                            <th>Biography</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($authors as $author)
                            <tr>
                                <td><strong>{{ $author->name }}</strong></td>
                                <td>
                                    <span class="badge bg-primary">{{ $author->books->count() }}</span>
                                </td>
                                <td>{{ Str::limit($author->biography, 40) ?? 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('authors.show', $author) }}" class="btn btn-sm btn-info btn-icon">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning btn-icon">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{ route('authors.destroy', $author) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                                <td colspan="4" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i><br>
                                    No authors found. <a href="{{ route('authors.create') }}">Create one now!</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $authors->links() }}
            </div>
        </div>
    </div>
@endsection
