@extends('layouts.app')

@section('content')
<!-- Add Google Fonts for a premium look -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Poppins:wght@500;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);
        --secondary-gradient: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: 1px solid rgba(255, 255, 255, 0.2);
    }

    body {
        font-family: 'Inter', sans-serif;
    }

    h1, h2, h3, h4, h5 {
        font-family: 'Poppins', sans-serif;
    }

    /* Hero Section Styling */
    .hero-section {
        background: var(--secondary-gradient);
        position: relative;
        overflow: hidden;
        min-height: 80vh;
        display: flex;
        align-items: center;
        border-radius: 25px;
    }

    /* Abstract Background Shapes */
    .hero-section::before {
        content: '';
        position: absolute;
        top: -10%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 0;
    }
    
    .hero-section::after {
        content: '';
        position: absolute;
        bottom: -10%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        padding: 3rem;
        border-radius: 20px;
        border: var(--glass-border);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    /* Feature Cards */
    .feature-card {
        transition: all 0.3s ease;
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: #fff;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .icon-box {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin: 0 auto 1.5rem;
        transition: transform 0.3s ease;
    }

    .feature-card:hover .icon-box {
        transform: scale(1.1) rotate(5deg);
    }

    /* Tech Stack */
    .tech-item {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    .tech-item:hover {
        transform: scale(1.05);
    }

    /* Steps */
    .step-number {
        background: var(--primary-gradient);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-right: 15px;
        flex-shrink: 0;
    }
</style>

<!-- Hero Section -->
<section class="hero-section text-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="hero-content text-center">
                    <div class="mb-4">
                        <span class="badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-rocket me-2"></i> v2.0 Now Live
                        </span>
                    </div>
                    <h1 class="display-4 fw-bold mb-3">
                        Mini Library <span class="text-transparent bg-clip-text" style="-webkit-background-clip: text; background-image: linear-gradient(to right, #fff, #a5b4fc);">Management System</span>
                    </h1>
                    <p class="lead mb-5 opacity-75" style="max-width: 700px; margin: 0 auto;">
                        Streamline your academic resources. Manage books, track student borrowing, and automate fines with our modern, responsive platform.
                    </p>
                    
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg px-5 rounded-pill shadow-lg fw-bold">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-light btn-lg px-5 rounded-pill shadow-lg fw-bold">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-5 rounded-pill">
                                    <i class="fas fa-user-plus me-2"></i> Register
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-none">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase ls-2">Capabilities</h6>
            <h2 class="fw-bold display-6">Everything you need to run a library</h2>
        </div>
        
        <div class="row g-4">
            <!-- Student Management -->
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100 p-4 shadow-sm">
                    <div class="icon-box bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Student Management</h5>
                    <p class="text-muted small">Create profiles, track academic details, and view complete borrowing history instantly.</p>
                </div>
            </div>
            
            <!-- Book Catalog -->
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100 p-4 shadow-sm">
                    <div class="icon-box bg-info bg-opacity-10 text-info">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Book Catalog</h5>
                    <p class="text-muted small">Organize your collection with categories, ISBN tracking, and real-time availability status.</p>
                </div>
            </div>
            
            <!-- Authors -->
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100 p-4 shadow-sm">
                    <div class="icon-box bg-warning bg-opacity-10 text-warning">
                        <i class="fas fa-feather-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Author Database</h5>
                    <p class="text-muted small">Maintain a robust database of authors and link them to multiple publications easily.</p>
                </div>
            </div>
            
            <!-- Transactions -->
            <div class="col-md-6 col-lg-3">
                <div class="card feature-card h-100 p-4 shadow-sm">
                    <div class="icon-box bg-danger bg-opacity-10 text-danger">
                        <i class="fas fa-exchange-alt"></i>
                    </div>
                    <h5 class="fw-bold mb-3">Smart Transactions</h5>
                    <p class="text-muted small">Automated checkout, returns, and fine calculation system (₱10/day) to keep things running.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <h6 class="text-primary fw-bold text-uppercase">Workflow</h6>
                <h2 class="fw-bold display-6 mb-4">How It Works</h2>
                <p class="text-muted mb-4">Whether you are a student looking for books or a librarian managing the system, the process is intuitive and fast.</p>
                
                <div class="d-flex align-items-start mb-4">
                    <div class="step-number me-3">1</div>
                    <div>
                        <h5 class="fw-bold">Register & Login</h5>
                        <p class="text-muted small">Secure access for students and administrators.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-4">
                    <div class="step-number me-3">2</div>
                    <div>
                        <h5 class="fw-bold">Browse & Borrow</h5>
                        <p class="text-muted small">Search the catalog and request books instantly.</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="step-number me-3">3</div>
                    <div>
                        <h5 class="fw-bold">Return & Track</h5>
                        <p class="text-muted small">Return books on time to avoid fines.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-7">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 bg-white p-4">
                            <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-user-graduate me-2"></i> For Students</h5>
                            <ul class="list-unstyled text-muted small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> View available books</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Check borrowing status</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> 14-day loan period</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Pay fines online</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 bg-white p-4">
                            <h5 class="fw-bold mb-3 text-primary"><i class="fas fa-user-tie me-2"></i> For Librarians</h5>
                            <ul class="list-unstyled text-muted small">
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Add/Edit Book records</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Manage student accounts</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Process transactions</li>
                                <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Generate reports</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Technology Stack -->
<section class="py-5 bg-dark rounded-4 text-white">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Built With Modern Technology</h2>
            <p class="text-white-50">Powerful, reliable, and scalable architecture.</p>
        </div>
        <div class="row justify-content-center g-4">
            <div class="col-md-3 col-6">
                <div class="tech-item text-center">
                    <i class="fab fa-laravel fa-3x text-danger mb-3"></i>
                    <h6 class="fw-bold">Laravel 12</h6>
                    <small class="text-muted">PHP Framework</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tech-item text-center">
                    <i class="fab fa-bootstrap fa-3x text-primary mb-3"></i>
                    <h6 class="fw-bold">Bootstrap 5</h6>
                    <small class="text-muted">UI Framework</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tech-item text-center">
                    <i class="fas fa-database fa-3x text-secondary mb-3"></i>
                    <h6 class="fw-bold">MySQL</h6>
                    <small class="text-muted">Database</small>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="tech-item text-center">
                    <i class="fas fa-code fa-3x text-info mb-3"></i>
                    <h6 class="fw-bold">Eloquent ORM</h6>
                    <small class="text-muted">Database Layer</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="py-5">
    <div class="container">
        <div class="bg-primary rounded-4 p-5 text-center text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%);">
            <div class="position-relative z-1">
                <h2 class="fw-bold mb-3">Ready to manage your library?</h2>
                <p class="lead mb-4 opacity-75">Join the system today and experience seamless book management.</p>
                @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow">
                        Go to Dashboard <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg rounded-pill px-5 fw-bold shadow me-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-bold">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection