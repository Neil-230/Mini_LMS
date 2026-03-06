@extends('layouts.app')

@section('title', 'Borrowing Details')

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
        word-break: break-word;
    }

    .info-value a {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }

    .info-value a:hover {
        color: var(--primary-color);
    }

    /* Transaction Grid */
    .transaction-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .transaction-item {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        border: 1px solid #e9ecef;
    }

    .transaction-label {
        color: #7f8c8d;
        font-size: 0.85rem;
        margin-bottom: 8px;
    }

    .transaction-value {
        color: var(--primary-color);
        font-weight: 700;
        font-size: 1.1rem;
    }

    /* Fine Section */
    .fine-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .fine-header {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: white;
        padding: 20px 25px;
        border-radius: 16px 16px 0 0;
    }

    .fine-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
    }

    .fine-body {
        padding: 25px;
    }

    .fine-amount {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--danger-color);
        line-height: 1;
    }

    .fine-calculation {
        background: #fff5f5;
        border: 1px solid #fed7d7;
        border-radius: 12px;
        padding: 20px;
    }

    .fine-calculation ul {
        margin: 0;
        padding-left: 20px;
    }

    .fine-calculation li {
        margin-bottom: 5px;
        color: #7f8c8d;
    }

    /* Badges */
    .badge {
        padding: 6px 12px;
        font-weight: 500;
        border-radius: 6px;
        font-size: 0.8rem;
    }

    .badge-primary {
        background-color: rgba(79, 70, 229, 0.15);
        color: var(--primary-color);
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .badge-warning {
        background-color: rgba(243, 156, 18, 0.15);
        color: #d68910;
        border: 1px solid rgba(243, 156, 18, 0.2);
    }

    .badge-success {
        background-color: rgba(39, 174, 96, 0.15);
        color: var(--success-color);
        border: 1px solid rgba(39, 174, 96, 0.2);
    }

    .badge-danger {
        background-color: rgba(231, 76, 60, 0.15);
        color: var(--danger-color);
        border: 1px solid rgba(231, 76, 60, 0.2);
    }

    /* Buttons */
    .btn-return {
        background: linear-gradient(135deg, #27ae60 0%, #2ecc71 100%);
        color: white;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        box-shadow: 0 4px 10px rgba(39, 174, 96, 0.3);
        transition: all 0.3s;
    }

    .btn-return:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(39, 174, 96, 0.4);
        color: white;
    }

    .btn-icon {
        display: inline-flex;
        align-items: center;
        gap: 8px;
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
</style>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('borrowings.index') }}">
                            <i class="fas fa-arrow-left me-1"></i> Borrowings
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="fas fa-file-invoice me-1"></i> Details
                    </li>
                </ol>
            </nav>
            <h1 class="page-title">
                <i class="fas fa-file-invoice text-primary"></i> Borrowing Details
            </h1>
        </div>
        <div class="col-md-4 text-end">
            @if($borrowing->status !== 'returned')
                <a href="{{ route('borrowings.return', $borrowing) }}" class="btn btn-return btn-icon">
                    <i class="fas fa-undo"></i> Return Books
                </a>
            @else
                <span class="badge badge-success px-3 py-2">
                    <i class="fas fa-check-circle me-2"></i> Completed
                </span>
            @endif
        </div>
    </div>

    <!-- Student & Book Info -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="info-card">
                <div class="info-header">
                    <h5><i class="fas fa-user me-2"></i> Student Information</h5>
                </div>
                <div class="info-body">
                    <div class="info-item">
                        <div class="info-label">Name</div>
                        <div class="info-value">
                            <a href="{{ route('students.show', $borrowing->student) }}">
                                {{ $borrowing->student->name }}
                            </a>
                        </div>
                    </div>
                    <div class="info-item