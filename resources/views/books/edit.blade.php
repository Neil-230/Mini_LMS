@extends('layouts.app')

@section('title', 'Edit Book')

@section('content')
<!-- Add Google Fonts for consistency -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        --secondary-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.3);
        --input-bg: #f8f9fa;
        --hover-bg: rgba(79, 70, 229, 0.05);
        --danger-color: #ef4444;
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

    /* Page Title */
    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
        padding-bottom: 15px;
        border-bottom: 2px solid #e9ecef;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 15px;
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

    /* Form Card */
    .form-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        overflow: hidden;
    }

    .form-header {
        background: var(--primary-gradient);
        color: white;
        padding: 25px 30px;
    }

    .form-header h2 {
        color: white;
        margin: 0;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .form-header p {
        color: rgba(255,255,255,0.8);
        margin: 5px 0 0 0;
        font-size: 0.9rem;
    }

    .form-body {
        padding: 30px;
    }

    /* Form Inputs */
    .form-label {
        font-weight: 600;
        color: #4f46e5;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
        transition: all 0.3s;
        background-color: var(--input-bg);
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.15);
        background-color: white;
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: var(--danger-color);
        padding-right: calc(1.5em + 0.75rem);
    }

    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 5px;
        color: var(--danger-color);
    }

    /* Buttons */
    .btn {
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: var(--primary-gradient);
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.4);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #4f46e5;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #4f46e5;
        transform: translateY(-2px);
    }

    /* Required Field */
    .text-danger {
        color: var(--danger-color) !important;
    }

    /* Textarea */
    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    /* Multi-select Helper */
    .helper-text {
        display: block;
        margin-top: 5px;
        font-size: 0.85rem;
        color: #64748b;
    }

    /* Select Multiple Styling */
    select[multiple] {
        height: auto;
        min-height: 120px;
    }

    /* Info Card */
    .info-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        overflow: hidden;
    }

    .info-header {
        background: var(--primary-gradient);
        color: white;
        padding: 15px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.2);
    }

    .info-header h5 {
        color: white;
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .info-body {
        padding: 20px;
    }

    .info-body ul {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .info-body li {
        margin-bottom: 8px;
        color: #64748b;
        font-size: 0.9rem;
    }

    .info-body strong {
        color: #1e293b;
    }

    /* Book Icon */
    .book-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 1.5rem;
    }
</style>

<div class="page-container">
    <div class="container">
        
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('books.index') }}">
                                <i class="fas fa-arrow-left me-1"></i> Books
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-edit me-1"></i> Edit Book
                        </li>
                    </ol>
                </nav>
                <h1 class="page-title">
                    <i class="fas fa-edit" style="color: #4f46e5;"></i> Edit Book
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Form Card -->
                <div class="form-card">
                    <div class="form-header">
                        <h2>Book Information</h2>
                        <p>Update the details below to modify book information</p>
                    </div>
                    
                    <div class="form-body">
                        <form action="{{ route('books.update', $book) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Book Title <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('title') is-invalid @enderror" 
                                       id="title" 
                                       name="title" 
                                       value="{{ old('title', $book->title) }}" 
                                       placeholder="Enter book title"
                                       required>
                                @error('title')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="isbn" class="form-label">ISBN <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('isbn') is-invalid @enderror" 
                                       id="isbn" 
                                       name="isbn" 
                                       value="{{ old('isbn', $book->isbn) }}" 
                                       placeholder="Enter ISBN number"
                                       required>
                                @error('isbn')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description" 
                                          rows="3" 
                                          placeholder="Enter book description">{{ old('description', $book->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="publisher" class="form-label">Publisher</label>
                                    <input type="text" 
                                           class="form-control @error('publisher') is-invalid @enderror" 
                                           id="publisher" 
                                           name="publisher" 
                                           value="{{ old('publisher', $book->publisher) }}" 
                                           placeholder="Enter publisher name">
                                    @error('publisher')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="published_year" class="form-label">Published Year</label>
                                    <input type="number" 
                                           class="form-control @error('published_year') is-invalid @enderror" 
                                           id="published_year" 
                                           name="published_year" 
                                           value="{{ old('published_year', $book->published_year) }}" 
                                           min="1000"
                                           placeholder="e.g. 2023">
                                    @error('published_year')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" 
                                       class="form-control @error('quantity') is-invalid @enderror" 
                                       id="quantity" 
                                       name="quantity" 
                                       value="{{ old('quantity', $book->quantity) }}" 
                                       required min="0">
                                @error('quantity')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="authors" class="form-label">Authors</label>
                                <select id="authors" 
                                        name="authors[]" 
                                        class="form-select @error('authors') is-invalid @enderror" 
                                        multiple>
                                    @foreach($authors as $author)
                                        <option value="{{ $author->id }}" {{ $book->authors->contains($author->id) ? 'selected' : '' }}>
                                            {{ $author->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="helper-text">
                                    <i class="fas fa-info-circle me-1"></i> Hold Ctrl (or Cmd) to select multiple authors
                                </small>
                                @error('authors')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-3 mt-4">
                                <a href="{{ route('books.show', $book) }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Update Book
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="info-card mt-3">
                    <div class="info-header">
                        <h5><i class="fas fa-info-circle me-2"></i> About Book Details</h5>
                    </div>
                    <div class="info-body">
                        <p><strong>Book Information:</strong></p>
                        <ul>
                            <li><strong>ISBN:</strong> Use the 10 or 13-digit International Standard Book Number</li>
                            <li><strong>Quantity:</strong> Enter the total number of copies available</li>
                            <li><strong>Authors:</strong> Select one or more authors from the dropdown</li>
                            <li><strong>Description:</strong> Provide a brief summary of the book content</li>
                            <li><strong>Required Fields:</strong> Marked with a red asterisk (*) must be filled</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection