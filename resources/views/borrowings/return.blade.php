@extends('layouts.app')

@section('title', 'Return Books')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="breadcrumb">
                <a href="{{ route('borrowings.index') }}" class="breadcrumb-item">Borrowings</a>
                <a href="{{ route('borrowings.show', $borrowing) }}" class="breadcrumb-item">Details</a>
                <span class="breadcrumb-item active">Return Books</span>
            </div>
            <h1 class="page-title">
                <i class="fas fa-undo"></i> Return Books
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Student Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="text-muted small">Name</label>
                        <p class="mb-0"><strong>{{ $borrowing->student->name }}</strong></p>
                    </div>
                    <div class="mb-2">
                        <label class="text-muted small">Student ID</label>
                        <p class="mb-0"><strong>{{ $borrowing->student->student_id }}</strong></p>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-book"></i> Book Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <label class="text-muted small">Title</label>
                        <p class="mb-0"><strong>{{ $borrowing->book->title }}</strong></p>
                    </div>
                    <div class="mb-2">
                        <label class="text-muted small">ISBN</label>
                        <p class="mb-0"><strong>{{ $borrowing->book->isbn }}</strong></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Borrowing Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="text-muted small">Borrowed Quantity</label>
                        <p class="mb-0"><strong>{{ $borrowing->quantity }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Already Returned</label>
                        <p class="mb-0"><strong>{{ $borrowing->returned_quantity }}</strong></p>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small">Outstanding</label>
                        <p class="mb-0">
                            <strong class="text-danger">{{ $maxReturnQuantity }}</strong>
                        </p>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small">Borrow Date</label>
                        <p class="mb-0"><strong>{{ $borrowing->borrow_date->format('M d, Y') }}</strong></p>
                    </div>
                    <div>
                        <label class="text-muted small">Due Date</label>
                        <p class="mb-0"><strong>{{ $borrowing->due_date->format('M d, Y') }}</strong></p>
                    </div>
                </div>
            </card>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-check-circle"></i> Process Return</h5>
                </div>
                <div class="card-body">
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
                            <input type="number" class="form-control @error('return_quantity') is-invalid @enderror" id="return_quantity" name="return_quantity" value="{{ old('return_quantity') }}" required min="1" max="{{ $maxReturnQuantity }}">
                            @error('return_quantity')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="return_date" class="form-label">Return Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('return_date') is-invalid @enderror" id="return_date" name="return_date" value="{{ old('return_date', date('Y-m-d')) }}" required>
                            @error('return_date')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card border-warning">
                            <div class="card-header bg-warning bg-opacity-10">
                                <h6 class="mb-0"><i class="fas fa-dollar-sign"></i> Fine Preview</h6>
                            </div>
                            <div class="card-body">
                                <p class="mb-2">
                                    <strong>Based on return date and overdue calculation:</strong>
                                </p>
                                <div class="alert alert-warning">
                                    <strong id="finePreview">Calculating...</strong>
                                </div>
                            </div>
                        </div>

                        <div class="gap-2 d-flex justify-content-end mt-4">
                            <a href="{{ route('borrowings.show', $borrowing) }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-check"></i> Process Return
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
                document.getElementById('finePreview').textContent = 'Enter return date and quantity to calculate fine.';
                return;
            }

            const returnDate = new Date(returnDateInput);

            if (returnDate < dueDate) {
                document.getElementById('finePreview').innerHTML = '<span class="text-success">✓ No fine - Book returned before due date!</span>';
                return;
            }

            const overdueDays = Math.floor((returnDate - dueDate) / (1000 * 60 * 60 * 24));
            const fineAmount = 10 * overdueDays * returnQuantity;

            document.getElementById('finePreview').innerHTML = `₱${fineAmount.toFixed(2)} (₱10 × ${overdueDays} days × ${returnQuantity} book${returnQuantity > 1 ? 's' : ''})`;
        }

        // Calculate on page load
        calculateFine();
    </script>
@endsection
