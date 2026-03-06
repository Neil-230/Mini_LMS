@extends('layouts.app')

@section('title', 'Authors')

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

    /* Author Badge */
    .author-badge {
        background: rgba(79, 70, 229, 0.1);
        color: #4f46e5;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
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

    /* Author Avatar */
    .author-avatar {
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

    /* Biography Text */
    .biography-text {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
    }
</style>

<div class="page-container">
    <div class="container">
        
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="fas fa-pen-fancy me-2" style="color: #4f46e5;"></i> Authors Management
                </h1>
                <p class="page-subtitle">Manage and track all author records in the system</p>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('authors.create') }}" class="btn btn-add">
                    <i class="fas fa-user-plus me-2"></i> Add New Author
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
                                <th>Author Name</th>
                                <th>Books</th>
                                <th>Biography</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($authors as $author)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="author-avatar">
                                                <i class="fas fa-pen-fancy"></i>
                                            </div>
                                            <div>
                                                <div class="fw-bold">{{ $author->name }}</div>
                                                <small class="text-muted">{{ $author->created_at->format('M d, Y') }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="author-badge">
                                            <i class="fas fa-book me-1"></i> {{ $author->books->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="biography-text">
                                            {{ Str::limit($author->biography, 50) ?? 'No biography available' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('authors.show', $author) }}" 
                                               class="btn btn-icon btn-view"
                                               aria-label="View author {{ $author->name }}">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('authors.edit', $author) }}" 
                                               class="btn btn-icon btn-edit"
                                               aria-label="Edit author {{ $author->name }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form method="POST" 
                                                  action="{{ route('authors.destroy', $author) }}" 
                                                  class="d-inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this author?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-icon btn-delete"
                                                        aria-label="Delete author {{ $author->name }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>No authors found. <a href="{{ route('authors.create') }}" class="text-primary fw-bold">Create one now!</a></p>
                                            <a href="{{ route('authors.create') }}" class="btn btn-add">
                                                <i class="fas fa-user-plus me-2"></i> Add First Author
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
                    {{ $authors->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection