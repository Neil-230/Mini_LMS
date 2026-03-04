<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Student;
use App\Models\Author;
use App\Models\Borrowing;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $totalBooks = Book::count();
        $totalStudents = Student::count();
        $totalAuthors = Author::count();
        $activeBorrowings = Borrowing::whereIn('status', ['borrowed', 'partially_returned'])->count();
        $overdueBooks = Borrowing::with('student', 'book')
            ->whereIn('status', ['borrowed', 'partially_returned'])
            ->get()
            ->filter(fn($b) => $b->isOverdue());

        return view('dashboard', compact(
            'totalBooks',
            'totalStudents',
            'totalAuthors',
            'activeBorrowings',
            'overdueBooks'
        ));
    }
}
