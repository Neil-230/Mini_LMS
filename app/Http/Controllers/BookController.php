<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books.
     */
    public function index()
    {
        $books = Book::with('authors')->paginate(10);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created book in database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books|max:20',
            'description' => 'nullable|string',
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'quantity' => 'required|integer|min:0',
            'authors' => 'array',
            'authors.*' => 'exists:authors,id',
        ]);

        $authors = $validated['authors'] ?? [];
        unset($validated['authors']);

        $validated['available_count'] = $validated['quantity'];

        $book = Book::create($validated);
        
        if (!empty($authors)) {
            $book->authors()->attach($authors);
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        $book->load('authors');
        $borrowings = $book->borrowings()->with('student')->latest()->paginate(10);
        return view('books.show', compact('book', 'borrowings'));
    }

    /**
     * Show the form for editing the book.
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $book->load('authors');
        return view('books.edit', compact('book', 'authors'));
    }

    /**
     * Update the specified book in database.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn,' . $book->id . '|max:20',
            'description' => 'nullable|string',
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1000|max:' . date('Y'),
            'quantity' => 'required|integer|min:' . $book->borrowings()->sum('returned_quantity'),
            'authors' => 'array',
            'authors.*' => 'exists:authors,id',
        ]);

        $authors = $validated['authors'] ?? [];
        unset($validated['authors']);

        $book->update($validated);
        
        $book->authors()->sync($authors);

        return redirect()->route('books.show', $book)->with('success', 'Book updated successfully.');
    }

    /**
     * Remove the specified book from database.
     */
    public function destroy(Book $book)
    {
        // Only allow deletion if no active borrowings
        if ($book->borrowings()->whereIn('status', ['borrowed', 'partially_returned'])->count() > 0) {
            return redirect()->route('books.index')->with('error', 'Cannot delete book with active borrowings.');
        }

        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
