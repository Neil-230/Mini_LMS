<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (Login/Register)
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login.store');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register.store');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Resource routes for Students
Route::resource('students', StudentController::class)->middleware('auth');

// Resource routes for Books
Route::resource('books', BookController::class)->middleware('auth');

// Resource routes for Authors
Route::resource('authors', AuthorController::class)->middleware('auth');

// Borrowing routes
Route::resource('borrowings', BorrowingController::class)->middleware('auth');
Route::get('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnForm'])->name('borrowings.return')->middleware('auth');
Route::post('/borrowings/{borrowing}/process-return', [BorrowingController::class, 'processReturn'])->name('borrowings.process-return')->middleware('auth');
Route::get('/students/{student}/borrowing-history', [BorrowingController::class, 'studentHistory'])->name('borrowings.student-history')->middleware('auth');
Route::get('/books/{book}/borrowing-history', [BorrowingController::class, 'bookHistory'])->name('borrowings.book-history')->middleware('auth');
Route::get('/api/books/{book}/available', [BorrowingController::class, 'getAvailableBooks'])->name('api.books.available')->middleware('auth');
