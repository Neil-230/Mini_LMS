<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    /**
     * Display a listing of borrowings.
     */
    public function index()
    {
        $borrowings = Borrowing::with('student', 'book')
            ->latest()
            ->paginate(10);
        
        foreach($borrowings as $borrowing) {
            $borrowing->fine_amount = $borrowing->calculateFine();
            $borrowing->save();
        }

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new borrowing.
     */
    public function create()
    {
        $students = Student::all();
        $books = Book::where('available_count', '>', 0)->get();
        return view('borrowings.create', compact('students', 'books'));
    }

    /**
     * Store a newly created borrowing in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'borrow_date' => 'required|date|before_or_equal:today',
            'due_date' => 'required|date|after:borrow_date',
        ]);

        $book = Book::find($validated['book_id']);

        // Check if enough books are available
        if ($book->available_count < $validated['quantity']) {
            return redirect()->back()->with('error', 'Not enough books available.');
        }

        $validated['status'] = 'borrowed';
        $validated['returned_quantity'] = 0;
        $validated['fine_amount'] = 0;

        $borrowing = Borrowing::create($validated);

        // Update book available count
        $book->available_count -= $validated['quantity'];
        $book->save();

        return redirect()->route('borrowings.show', $borrowing)->with('success', 'Book borrowed successfully.');
    }

    /**
     * Display the specified borrowing.
     */
    public function show(Borrowing $borrowing)
    {
        $borrowing->fine_amount = $borrowing->calculateFine();
        return view('borrowings.show', compact('borrowing'));
    }

    /**
     * Show the form for returning books.
     */
    public function returnForm(Borrowing $borrowing)
    {
        $maxReturnQuantity = $borrowing->quantity - $borrowing->returned_quantity;
        return view('borrowings.return', compact('borrowing', 'maxReturnQuantity'));
    }

    /**
     * Process book return and calculate fine.
     */
    public function processReturn(Request $request, Borrowing $borrowing)
    {
        $maxReturnQuantity = $borrowing->quantity - $borrowing->returned_quantity;

        $validated = $request->validate([
            'return_quantity' => 'required|integer|min:1|max:' . $maxReturnQuantity,
            'return_date' => 'required|date|after_or_equal:' . $borrowing->borrow_date,
        ]);

        // Update borrowing record
        $borrowing->returned_quantity += $validated['return_quantity'];
        $borrowing->return_date = $validated['return_date'];

        // Calculate fine
        $returnDate = Carbon::parse($validated['return_date']);
        if ($returnDate->gt($borrowing->due_date)) {
            $overdueDays = $borrowing->due_date->diffInDays($returnDate);
            $borrowing->fine_amount = 10 * $overdueDays * $validated['return_quantity'];
        }

        // Update status
        if ($borrowing->returned_quantity === $borrowing->quantity) {
            $borrowing->status = 'returned';
        } else {
            $borrowing->status = 'partially_returned';
        }

        $borrowing->save();

        // Update book available count
        $book = $borrowing->book;
        $book->available_count += $validated['return_quantity'];
        $book->save();

        return redirect()->route('borrowings.show', $borrowing)->with('success', 'Book return processed successfully.');
    }

    /**
     * Show borrowing history for a student.
     */
    public function studentHistory(Student $student)
    {
        $borrowings = $student->borrowings()->with('book')->latest()->paginate(10);

        foreach($borrowings as $borrowing) {
            $borrowing->fine_amount = $borrowing->calculateFine();
        }

        return view('borrowings.student-history', compact('student', 'borrowings'));
    }

    /**
     * Show borrowing history for a book.
     */
    public function bookHistory(Book $book)
    {
        $borrowings = $book->borrowings()->with('student')->latest()->paginate(10);

        foreach($borrowings as $borrowing) {
            $borrowing->fine_amount = $borrowing->calculateFine();
        }

        return view('borrowings.book-history', compact('book', 'borrowings'));
    }

    /**
     * Get available books based on quantity.
     */
    public function getAvailableBooks(Book $book)
    {
        return response()->json([
            'available_count' => $book->available_count,
        ]);
    }
}
