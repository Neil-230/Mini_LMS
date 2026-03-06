@extends('layouts.app')

@section('title', 'Books')

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

    /* Action Button */
    .btn-add {
        background: var(--primary-gradient);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
        color: white;
    }

    /* Table Container */
    .table-container {
        border-radius: 16px;
        overflow: hidden;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: rgba(79, 70, 229, 0.05);
        color: #4f46e5;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 2px solid rgba(79, 70, 229, 0.1);
    }

    .table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #e2e8f0;
    }

    .table tbody tr:hover {
        background: var(--hover-bg);
        transform: translateX(2px);
    }

    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        color: #334155;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Book Badge */
    .book-badge {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Author Badge */
    .author-badge {
        background: rgba(56, 189, 248, 0.1);
        color: #0ea5e9;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.8rem;
        margin-right: 0.5rem;
        margin-bottom: 0.25rem;
        display: inline-block;
    }

    /* Action Buttons */
    .btn-icon {
        padding: 0.5rem 0.8rem;
        border-radius: 10px;
        font-size: 0.85rem;
        transition: all 0.2s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
    }

    .btn-view {
        background: rgba(56, 189, 248, 0.1);
        color: #0ea5e9;
    }

    .btn-view:hover {
        background: #0ea5e9;
        color: white;
    }

    .btn-edit {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .btn-edit:hover {
        background: #f59e0b;
        color: white;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state i {
        color: #94a3b8;
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #64748b;
        margin-bottom: 1.5rem;
    }

    /* Pagination */
    .pagination {
        margin-top: 2rem;
    }

    .pagination .page-link {
        border: none;
        border-radius: 10px;
        margin: 0 0.25rem;
        color: #4f46e5;
        background: rgba(79, 70, 229, 0.05);
        transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
    }

    .pagination .active .page-link {
        background: var(--primary-gradient);
        color: white;
    }

    /* Book Icon */
    .book-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        color: white;
        font-size: 1rem;
    }

    /* Quantity Badge */
    .quantity-badge {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    .quantity-badge.danger {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
    }
</style>

<div class="page-container">
    <div class="container">
        
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-books me-2" style="color: #4f46e5;"></i> Books Management
                </h1>
                <p class="page-subtitle">Manage and track all book records in the system</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('books.create') }}" class="btn btn-add">
                    <i class="fas fa-book-plus me-2"></i> Add New Book
                </a>
            </div>
        </div>

        <!-- Glass Card -->
        <div class="glass-card p-4 p-md-5">
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ISBN</th>
                                <th>Title</th>
                                <th>Authors</th>
                                <th>Publisher</th>
                                <th>Quantity</th>
                                <th>Available</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($books as $book)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="book-icon">
                                                <i class="fas fa-book"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $book->isbn }}</div>
                                                <small class="text-muted">{{ $book->created_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold">{{ $book->title }}</div>
                                        <small class="text-muted">{{ $book->publisher ?? 'N/A' }}</small>
                                    </td>
                                    <td>
                                        @forelse($book->authors as $author)
                                            <span class="author-badge">
                                                <i class="fas fa-user me-1"></i> {{ $author->name }}
                                            </span>
                                        @empty
                                            <span class="text-muted">No authors</span>
                                        @endforelse
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $book->publisher ?? 'N/A' }}</span>
                                    </td>
                                    <td>
                                        <span class="quantity-badge">{{ $book->quantity }}</span>
                                    </td>
                                    <td>
                                        @if($book->available_count > 0)
                                            <span class="quantity-badge">
                                                <i class="fas fa-check-circle me-1"></i> {{ $book->available_count }}
                                            </span>
                                        @else
                                            <span class="quantity-badge danger">
                                                <i class="fas fa-times-circle me-1"></i> 0
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('books.show', $book) }}" 
                                               class="btn btn-icon btn-view"
                                               aria-label="View book {{ $book->title }}">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('books.edit', $book) }}" 
                                               class="btn btn-icon btn-edit"
                                               aria-label="Edit book {{ $book->title }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form method="POST" 
                                                  action="{{ route('books.destroy', $book) }}" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-icon btn-delete"
                                                        aria-label="Delete book {{ $book->title }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fas fa-book-open"></i>
                                            <p>No books found. <a href="{{ route('books.create') }}" class="text-primary fw-bold">Create one now!</a></p>
                                            <a href="{{ route('books.create') }}" class="btn btn-add">
                                                <i class="fas fa-book-plus me-2"></i> Add First Book
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $books->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection