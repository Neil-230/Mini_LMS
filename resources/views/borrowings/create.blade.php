@extends('layouts.app')

@section('title', 'New Borrowing')

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="breadcrumb">
                <a href="{{ route('borrowings.index') }}" class="breadcrumb-item">Borrowings</a>
                <span class="breadcrumb-item active">New Borrowing</span>
            </div>
            <h1 class="page-title">
                <i class="fas fa-plus-square"></i> Create New Borrowing
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
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

                        <div class="gap-2 d-flex justify-content-end">
                            <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Create Borrowing
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header bg-info">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> About Borrowing</h5>
                </div>
                <div class="card-body">
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
@endsection
