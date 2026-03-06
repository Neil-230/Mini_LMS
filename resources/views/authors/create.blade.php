@extends('layouts.app')

@section('title', 'Add Author')

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

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 15px;
    }

    .breadcrumb-item a {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .breadcrumb-item a:hover {
        color: var(--primary-color);
    }

    .breadcrumb-item.active {
        color: var(--primary-color);
        font-weight: 600;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
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
        color: var(--primary-color);
        margin-bottom: 8px;
        font-size: 0.95rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }

    .form-control:focus, .form-select:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
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
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        box-shadow: 0 4px 10px rgba(79, 70, 229, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(79, 70, 229, 0.4);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: var(--primary-color);
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    /* Required Field */
    .text-danger {
        color: var(--danger-color) !important;
    }

    /* Textarea */
    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* Multi-select Helper */
    .helper-text {
        display: block;
        margin-top: 5px;
        font-size: 0.85rem;
        color: #7f8c8d;
    }

    /* Select Multiple Styling */
    select[multiple] {
        height: auto;
        min-height: 120px;
    }

    /* Info Card */
    .info-card {
        background: #f8f9fa;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        overflow: hidden;
    }

    .info-header {
        background: #e9ecef;
        padding: 15px 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .info-header h5 {
        margin: 0;
        font-size: 1rem;
        color: var(--primary-color);
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
        color: #555;
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('authors.index') }}">
                            <i class="fas fa-arrow-left me-1"></i> Authors
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-user-plus me-1"></i> Add New Author
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">
                <i class="fas fa-user-plus text-primary"></i> Add New Author
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Form Card -->
            <div class="form-card">
                <div class="form-header">
                    <h2>Author Information</h2>
                    <p>Fill in the details below to add a new author to the collection</p>
                </div>
                
                <div class="form-body">
                    <form action="{{ route('authors.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Author Name <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}" 
                                   placeholder="Enter author name"
                                   required>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="biography" class="form-label">Biography</label>
                            <textarea class="form-control @error('biography') is-invalid @enderror" 
                                      id="biography" 
                                      name="biography" 
                                      rows="4" 
                                      placeholder="Enter author biography">{{ old('biography') }}</textarea>
                            @error('biography')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Create Author
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="info-card mt-3">
                <div class="info-header">
                    <h5><i class="fas fa-info-circle me-2"></i> About Author Details</h5>
                </div>
                <div class="info-body">
                    <p><strong>Author Information:</strong></p>
                    <ul>
                        <li><strong>Name:</strong> Enter the full name of the author</li>
                        <li><strong>Biography:</strong> Provide a brief summary of the author's background and achievements</li>
                        <li><strong>Required Fields:</strong> Marked with a red asterisk (*) must be filled</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection