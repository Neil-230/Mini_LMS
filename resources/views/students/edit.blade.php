@extends('layouts.app')

@section('title', 'Edit Student')

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

    /* Student Avatar */
    .student-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2rem;
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
                            <a href="{{ route('students.index') }}">
                                <i class="fas fa-arrow-left me-1"></i> Students
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-edit me-1"></i> Edit Student
                        </li>
                    </ol>
                </nav>
                <h1 class="page-title">
                    <i class="fas fa-edit" style="color: #4f46e5;"></i> Edit Student
                </h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <!-- Form Card -->
                <div class="form-card">
                    <div class="form-header">
                        <h2>Update Student Information</h2>
                        <p>Modify the details below to update student records</p>
                    </div>
                    
                    <div class="form-body">
                        <form action="{{ route('students.update', $student) }}" method="POST" novalidate>
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $student->name) }}" 
                                       placeholder="Enter full name"
                                       required>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="student_id" class="form-label">Student ID <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('student_id') is-invalid @enderror" 
                                           id="student_id" 
                                           name="student_id" 
                                           value="{{ old('student_id', $student->student_id) }}" 
                                           placeholder="Enter student ID"
                                           required>
                                    @error('student_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           id="email" 
                                           name="email" 
                                           value="{{ old('email', $student->email) }}" 
                                           placeholder="student@example.com"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $student->phone) }}" 
                                       placeholder="09XX-XXX-XXXX">
                                @error('phone')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" 
                                          name="address" 
                                          rows="3" 
                                          placeholder="Enter full address">{{ old('address', $student->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('students.show', $student) }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Update Student
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Card -->
                <div class="info-card mt-3">
                    <div class="info-header">
                        <h5><i class="fas fa-info-circle me-2"></i> About Student Details</h5>
                    </div>
                    <div class="info-body">
                        <p><strong>Student Information:</strong></p>
                        <ul>
                            <li><strong>Full Name:</strong> Enter the complete name of the student</li>
                            <li><strong>Student ID:</strong> Use the official student identification number</li>
                            <li><strong>Email:</strong> Provide a valid email address for communication</li>
                            <li><strong>Phone:</strong> Enter a contact number for emergency purposes</li>
                            <li><strong>Required Fields:</strong> Marked with a red asterisk (*) must be filled</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection