@extends('layouts.app')

@section('title', $author->name)

@section('content')
<!-- Add Google Fonts for consistency -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.3);
        --input-bg: #f8f9fa;
        --hover-bg: rgba(79, 70, 229, 0.05);
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

    /* Glass Card */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        position: relative;
        z-index: 10;
    }

    /* Page Title */
    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: #64748b;
        font-size: 0.95rem;
    }

    /* Breadcrumb */
    .breadcrumb {
        background: transparent;
        padding: 0;
        margin-bottom: 1rem;
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

    /* Action Buttons */
    .btn-icon {
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
    }

    .btn-edit {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 158, 11, 0.3);
    }

    .btn-edit:hover {
        box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4);
        color: white;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        color: white;
    }

    /* Info Card */
    .info-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        height: 100%;
    }

    .info-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 24px 24px 0 0;
    }

    .info-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .info-body {
        padding: 2rem;
    }

    .info-item {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .info-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .info-label {
        color: #64748b;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .info-value {
        color: #1e293b;
        font-size: 1rem;
        font-weight: 600;
    }

    /* Books Grid Card */
    .books-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: var(--glass-border);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        overflow: hidden;
    }

    .books-header {
        background: var(--primary-gradient);
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 24px 24px 0 0;
    }

    .books-header h5 {
        color: white;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .books-body {
        padding: 2rem;
    }

    /* Book Card */
    .book-card {
        background: white;
        border-radius: 16px;
        border: 1px solid rgba(79, 70, 229, 0.1);
        padding: 1.5rem;
        transition: all 0.3s ease;
        height: 100%;
    }

    .book-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.15);
        border-color: rgba(79, 70, 229, 0.3);
    }

    .book-title {
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .book-meta {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .book-meta strong {
        color: #4f46e5;
    }

    /* Badges */
    .badge {
        padding: 0.4rem 0.8rem;
        font-weight: 500;
        border-radius: 8px;
        font-size: 0.75rem;
    }

    .badge-primary {
        background-color: rgba(79, 70, 229, 0.15);
        color: #4f46e5;
        border: 1px solid rgba(79, 70, 229, 0.2);
    }

    .badge-warning {
        background-color: rgba(245, 158, 11, 0.15);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .badge-success {
        background-color: rgba(16, 185, 129, 0.15);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .badge-danger {
        background-color: rgba(239, 68, 68, 0.15);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: #64748b;
    }

    .empty-state i {
        font-size: 3rem;
        color: #94a3b8;
        margin-bottom: 1rem;
    }

    /* View Button */
    .btn-info {
        background: rgba(56, 189, 248, 0.1);
        color: #0ea5e9;
        padding: 0.5rem 0.8rem;
        border-radius: 10px;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-info:hover {
        background: #0ea5e9;
        color: white;
        transform: translateY(-2px);
    }

    /* Author Avatar */
    .author-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: white;
        font-size: 2.5rem;
    }

    /* Biography Text */
    .biography-text {
        line-height: 1.8;
        color: #334155;
        font-size: 0.95rem;
    }
</style>

<div class="page-container">
    <div class="container">
        <!-- Page Header -->
        <div class="row">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('authors.index') }}">
                                <i class="fas fa-arrow-left me-1"></i> Authors
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <i class="fas fa-user-tie me-1"></i> {{ $author->name }}
                        </li>
                    </ol>
                </nav>
                <h1 class="page-title">
                    <i class="fas fa-user-tie me-2" style="color: #4f46e5;"></i> {{ $author->name }}
                </h1>
                <p class="page-subtitle">Author ID: {{ $author->id }}</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('authors.edit', $author) }}" class="btn btn-icon btn-edit">
                    <i class="fas fa-edit me-2"></i> Edit
                </a>
                <form method="POST" action="{{ route('authors.destroy', $author) }}" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this author?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-icon btn-delete">
                        <i class="fas fa-trash me-2"></i> Delete
                    </button>
                </form>
            </div>
        </div>

        <div class="row g-4">
            <!-- Author Information -->
            <div class="col-md-4">
                <div class="glass-card info-card">
                    <div class="info-header">
                        <h5><i class="fas fa-info-circle me-2"></i> Author Information</h5>
                    </div>
                    <div class="info-body">
                        <!-- Avatar -->
                        <div class="author-avatar">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Full Name</div>
                            <div class="info-value">{{ $author->name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Biography</div>
                            <div class="info-value">
                                @if($author->biography)
                                    <p class="biography-text mb-0">{{ Str::limit($author->biography, 150) }}</p>
                                @else
                                    <span class="text-muted">No biography available</span>
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Total Books</div>
                            <div class="info-value">
                                <span class="badge badge-primary">{{ $author->books->count() }}</span>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Created At</div>
                            <div class="info-value">{{ $author->created_at->format('M d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Published Books -->
            <div class="col-md-8">
                <div class="books-card">
                    <div class="books-header">
                        <h5><i class="fas fa-books me-2"></i> Published Books</h5>
                    </div>
                    <div class="books-body">
                        @if($author->books->count() > 0)
                            <div class="row">
                                @foreach($author->books as $book)
                                    <div class="col-md-6 mb-3">
                                        <div class="book-card">
                                            <h6 class="book-title">{{ $book->title }}</h6>
                                            <p class="book-meta">
                                                <strong>ISBN:</strong> {{ $book->isbn }}
                                            </p>
                                            <p class="book-meta">
                                                <strong>Available:</strong> 
                                                <span class="badge badge-success">{{ $book->available_count }}</span>
                                            </p>
                                            <a href="{{ route('books.show', $book) }}" class="btn btn-info btn-sm w-100">
                                                <i class="fas fa-eye me-1"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-book-open"></i>
                                <p class="mb-0">No books published by this author yet</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection