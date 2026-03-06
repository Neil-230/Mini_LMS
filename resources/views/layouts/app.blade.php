<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --success-color: #27ae60;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
            --info-color: #17a2b8;

            /* map to Bootstrap CSS variables so views that use --bs-* work */
            --bs-primary: var(--primary-color);
            --bs-secondary: var(--secondary-color);
            --bs-success: var(--success-color);
            --bs-danger: var(--danger-color);
            --bs-warning: var(--warning-color);
            --bs-info: var(--info-color);
        }

        body {
            background-color: #ecf0f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        /* --- MODIFIED NAVBAR STYLES --- */
        .navbar {
            background: white;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 15px 20px;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
            margin: 0 5px;
            transition: all 0.3s;
            position: relative;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Underline effect on hover */
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--secondary-color);
            transition: width 0.3s;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-radius: 12px;
            margin-top: 10px;
        }

        .dropdown-item {
            color: var(--primary-color);
            padding: 10px 20px;
        }

        .dropdown-item:hover {
            background-color: var(--secondary-color);
            color: white;
        }

        /* --- END MODIFIED NAVBAR --- */

        .sidebar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            border-radius: 8px 8px 0 0;
        }

        .table {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background-color: var(--primary-color);
            color: white;
            border: none;
            font-weight: 600;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .alert {
            border: none;
            border-radius: 8px;
        }

        .badge-overdue {
            background-color: var(--danger-color);
        }

        .badge-active {
            background-color: var(--success-color);
        }

        .badge-returned {
            background-color: #95a5a6;
        }

        .page-title {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid var(--secondary-color);
        }

        .dashboard-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .dashboard-card .card-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        .dashboard-card .card-label {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .form-control, .form-select {
            border-radius: 6px;
            border: 1px solid #bdc3c7;
            padding: 10px 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-icon {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 12px;
            font-size: 0.9rem;
        }

        .text-muted {
            color: #7f8c8d !important;
        }

        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            margin-top: 40px;
            text-align: center;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0 0 15px 0;
        }

        .breadcrumb-item.active {
            color: var(--secondary-color);
            font-weight: 600;
        }

        label {
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 8px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation (Floating Card Style) -->
    <nav class="navbar navbar-expand-lg navbar-light m-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="fas fa-book"></i> Library Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fas fa-chart-line"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-graduation-cap"></i> Modules
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('students.index') }}"><i class="fas fa-user-graduate"></i> Students</a></li>
                            <li><a class="dropdown-item" href="{{ route('books.index') }}"><i class="fas fa-book"></i> Books</a></li>
                            <li><a class="dropdown-item" href="{{ route('authors.index') }}"><i class="fas fa-pen-fancy"></i> Authors</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('borrowings.index') }}"><i class="fas fa-exchange-alt"></i> Borrowings</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border: none; background: none; cursor: pointer; color: var(--danger-color) !important;">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid ">
        <!-- Alerts -->
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation-triangle"></i> Error!</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p class="mb-none">&copy; 2026 Library Management System - IT1313 LMS</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @yield('scripts')
</body>
</html>