@extends('layouts.app')

@section('title', $author->name)

@section('content')
    <div class="row mb-4">
        <div class="col-md-8">
            <div class="breadcrumb">
                <a href="{{ route('authors.index') }}" class="breadcrumb-item">Authors</a>
                <span class="breadcrumb-item active">{{ $author->name }}</span>
            </div>
            <h1 class="page-title">
                <i class="fas fa-user-tie"></i> {{ $author->name }}
            </h1>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('authors.edit', $author) }}" class="btn btn-warning btn-icon">
                <i class="fas fa-edit"></i> Edit
            </a>
            <form method="POST" action="{{ route('authors.destroy', $author) }}" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
            @if($author->biography)
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-file-alt"></i> Biography</h5>
                    </div>
                    <div class="card-body">
                        <p>{{ $author->biography }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-books"></i> Published Books</h5>
                </div>
                <div class="card-body">
                    @if($author->books->count() > 0)
                        <div class="row">
                            @foreach($author->books as $book)
                                <div class="col-md-6 mb-3">
                                    <div class="card border">
                                        <div class="card-body">
                                            <h6 class="card-title">{{ $book->title }}</h6>
                                            <p class="small text-muted mb-2">
                                                <strong>ISBN:</strong> {{ $book->isbn }}
                                            </p>
                                            <p class="small text-muted mb-2">
                                                <strong>Available:</strong> 
                                                <span class="badge bg-success">{{ $book->available_count }}</span>
                                            </p>
                                            <a href="{{ route('books.show', $book) }}" class="btn btn-sm btn-info btn-icon w-100">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted text-center py-4">
                            <i class="fas fa-inbox fa-2x mb-2"></i><br>
                            No books published by this author yet.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
