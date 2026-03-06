@extends('layouts.app')

@section('title', 'New Borrowing')

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

    /* Info Card */
    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .info-header {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
        padding: 20px 25px;
        border-radius: 16px 16px 0 0;
    }

    .info-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
    }

    .info-body {
        padding: 25px;
    }

    .info-body ul {
        margin: 0;
        padding-left: 20px;
    }

    .info-body li {
        margin-bottom: 10px;
        color: #7f8c8d;
    }

    .info-body strong {
        color: var(--primary-color);
    }
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('borrowings.index') }}">
                            <i class="fas fa-arrow-left me-1"></i> Borrowings
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-plus-square me-1"></i> New Borrowing
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">
                <i class="fas fa-plus-square text-primary"></i> Create New Borrowing
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <!-- Form Card -->
            <div class="form-card">
                <div class="form-header">
                    <h2>Transaction Details</h2>
                    <p>Fill in the information below to process a new book borrowing</p>
                </div>
                
                <div class="form-body">
                    <form action="{{ route('borrowings.store') }}" method="POST" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="student_id" class="form-label">Student <span class="text-danger">*</span></label>
                            <select class="form-select @error('student_id') is-invalid @enderror" id="student_id" name="student_id" required>
                                <option value="">-- Select a Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->name }} ({{ $student->student_id }})
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="book_id" class="form-label">Book <span class="text-danger">*</span></label>
                            <select class="form-select @error('book_id') is-invalid @enderror" id="book_id" name="book_id" required>
                                <option value="">-- Select a Book --</option>
                                @foreach($books as $book)
                                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                                        {{ $book->title }} (Available: {{ $book->available_count }})
                                    </option>
                                @endforeach
                            </select>
                            @error('book_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity', 1) }}" required min="1">
                            @error('quantity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="borrow_date" class="form-label">Borrow Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('borrow_date') is-invalid @enderror" id="borrow_date" name="borrow_date" value="{{ old('borrow_date', date('Y-m-d')) }}" required>
                                @error('borrow_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('due_date') is-invalid @enderror" id="due_date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" required>
                                @error('due_date')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Create Borrowing
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="info-card mt-3">
                <div class="info-header">
                    <h5><i class="fas fa-info-circle me-2"></i> About Borrowing</h5>
                </div>
                <div class="info-body">
                    <p><strong>Borrowing Process:</strong></p>
                    <ul>
                        <li>Select a student and book from dropdowns</li>
                        <li>Set the borrow date and due date</li>
                        <li>Books will be tracked and available count will be updated</li>
                        <li>Late returns will incur a fine of ₱10 per day per book</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection