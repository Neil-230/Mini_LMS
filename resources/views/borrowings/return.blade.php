@extends('layouts.app')

@section('title', 'Return Books')

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

    /* Info Cards */
    .info-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        height: 100%;
        overflow: hidden;
    }

    .info-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        color: white;
        padding: 20px 25px;
        border-radius: 16px 16px 0 0;
    }

    .info-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .info-body {
        padding: 25px;
    }

    .info-item {
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f1f1;
    }

    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-label {
        color: #7f8c8d;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .info-value {
        color: var(--primary-color);
        font-size: 1rem;
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
        background: linear-gradient(135deg, var(--success-color) 0%, #2ecc71 100%);
        color: white;
        padding: 25px 30px;
    }

    .form-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
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

    .form-control {
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 12px 15px;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }

    .form-control:focus {
        border-color: var(--secondary-color);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        background-color: white;
    }

    .form-control.is-invalid {
        border-color: var(--danger-color);
        padding-right: calc(1.5em + 0.75rem);
    }

    .invalid-feedback {
        font-size: 0.85rem;
        margin-top: 5px;
        color: var(--danger-color);
    }

    /* Fine Preview */
    .fine-preview {
        background: #fff8e1;
        border: 1px solid #ffe082;
        border-radius: 12px;
        padding: 20px;
        margin-top: 20px;
    }

    .fine-preview h6 {
        color: #f57f17;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .fine-amount {
        font-size: 1.5rem;
        font-weight: 700;
        color: #f57f17;
    }

    /* Buttons */
    .btn {
        border-radius: 10px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success-color) 0%, #2ecc71 100%);
        box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(39, 174, 96, 0.4);
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

    /* Alert */
    .alert-info {
        background-color: rgba(23, 162, 184, 0.1);
        border: 1px solid rgba(23, 162, 184, 0.2);
        color: var(--info-color);
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .alert-warning {
        background-color: rgba(243, 156, 18, 0.1);
        border: 1px solid rgba(243, 156, 18, 0.2);
        color: #d68910;
        border-radius: 10px;
        padding: 15px;
        margin: 0;
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
                    <li class="breadcrumb-item">
                        <a href="{{ route('borrowings.show', $borrowing) }}">
                            <i class="fas fa-file-invoice me-1"></i> Details
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-undo me-1"></i> Return Books
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">
                <i class="fas fa-undo text-success"></i> Return Books
            </h1>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="info-card">
                <div class="info-header">
                    <h5><i class="fas fa-user me-2"></i> Student Information</h5>
                </div>
                <div class="info-body">
                    <div class="info-item">
                        <div class="info-label">Name</div>
                        <div class="info-value">{{ $borrowing->student->name }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Student ID</div>
                        <div class="info-value">{{ $borrowing->student->student_id }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="info-card">
                <div class="info-header">
                    <h5><i class="fas fa-book me-2"></i> Book Information</h5>
                </div>
                <div class="info-body">
                    <div class="info-item">
                        <div class="info-label">Title</div>
                        <div class="info-value">{{ $borrowing->book->title }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">ISBN</div>
                        <div class="info-value">{{ $borrowing->book->isbn }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Borrowing Details & Form -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="info-card">
                <div class="info-header">
                    <h5><i class="fas fa-info-circle me-2"></i> Borrowing Details</h5>
                </div>
                <div class="info-body">
                    <div class="info-item">
                        <div class="info-label">Borrowed Quantity</div>
                        <div class="info-value">{{ $borrowing->quantity }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Already Returned</div>
                        <div class="info-value">{{ $borrowing->returned_quantity }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Outstanding</div>
                        <div class="info-value text-danger">{{ $maxReturnQuantity }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Borrow Date</div>
                        <div class="info-value">{{ $borrowing->borrow_date->format('M d, Y') }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Due Date</div>
                        <div class="info-value">{{ $borrowing->due_date->format('M d, Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-card">
                <div class="form-header">
                    <h5><i class="fas fa-check-circle me-2"></i> Process Return</h5>
                </div>
                <div class="form-body">
                    <form action="{{ route('borrowings.process-return', $borrowing) }}" method="POST" novalidate>
                        @csrf

                        <div class="alert alert-info">
                            <strong><i class="fas fa-info-circle"></i> Note:</strong> You can return partial or full quantity of books.
                        </div>

                        <div class="mb-3">
                            <label for="return_quantity" class="form-label">
                                Return Quantity <span class="text-danger">*</span>
                                <small class="text-muted">(Max: {{ $maxReturnQuantity }})</small>
                            </label>
                            <input type="number" 
                                   class="form-control @error('return_quantity') is-invalid @enderror" 
                                   id="return_quantity" 
                                   name="return_quantity" 
                                   value="{{ old('return_quantity') }}" 
                                   required min="1" max="{{ $maxReturnQuantity }}">
                            @error('return_quantity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="return_date" class="form-label">Return Date <span class="text-danger">*</span></label>
                            <input type="date" 
                                   class="form-control @error('return_date') is-invalid @enderror" 
                                   id="return_date" 
                                   name="return_date" 
                                   value="{{ old('return_date', date('Y-m-d')) }}" 
                                   required>
                            @error('return_date')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="fine-preview">
                            <h6><i class="fas fa-dollar-sign me-2"></i> Fine Preview</h6>
                            <div class="alert alert-warning">
                                <strong id="finePreview">Calculating...</strong>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check me-2"></i> Process Return
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('return_date').addEventListener('change', calculateFine);
        document.getElementById('return_quantity').addEventListener('input', calculateFine);

        function calculateFine() {
            const dueDate = new Date('{{ $borrowing->due_date->format('Y-m-d') }}');
            const returnDateInput = document.getElementById('return_date').value;
            const returnQuantity = parseInt(document.getElementById('return_quantity').value) || 0;

            if (!returnDateInput || returnQuantity <= 0) {
                document.getElementById('finePreview').innerHTML = '<span class="text-muted">Enter return date and quantity to calculate fine.</span>';
                return;
            }

            const returnDate = new Date(returnDateInput);

            if (returnDate < dueDate) {
                document.getElementById('finePreview').innerHTML = '<span class="text-success"><i class="fas fa-check-circle me-2"></i>No fine - Book returned before due date!</span>';
                return;
            }

            const overdueDays = Math.floor((returnDate - dueDate) / (1000 * 60 * 60 * 24));
            const fineAmount = 10 * overdueDays * returnQuantity;

            document.getElementById('finePreview').innerHTML = `
                <span class="text-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    ₱${fineAmount.toFixed(2)} (₱10 × ${overdueDays} days × ${returnQuantity} book${returnQuantity > 1 ? 's' : ''})
                </span>
            `;
        }

        // Calculate on page load
        calculateFine();
    </script>
</div>
@endsection