@extends('layouts.app')

@section('title', 'Edit Author')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="breadcrumb">
                <a href="{{ route('authors.index') }}" class="breadcrumb-item">Authors</a>
                <span class="breadcrumb-item active">Edit Author</span>
            </div>
            <h1 class="page-title">
                <i class="fas fa-edit"></i> Edit Author
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('authors.update', $author) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Author Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $author->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biography" class="form-label">Biography</label>
                            <textarea class="form-control @error('biography') is-invalid @enderror" id="biography" name="biography" rows="4">{{ old('biography', $author->biography) }}</textarea>
                            @error('biography')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="gap-2 d-flex justify-content-end">
                            <a href="{{ route('authors.show', $author) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Author
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
