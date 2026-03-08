<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'book_id',
        'quantity',
        'borrow_date',
        'due_date',
        'return_date',
        'returned_quantity',
        'fine_amount',
        'status',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    /**
     * Get the student for this borrowing.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the book for this borrowing.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /**
     * Calculate fine amount based on overdue days.
     * Fine = ₱10 × number of overdue days × number of books
     */
    public function calculateFine(): float
    {
        $now = Carbon::now();
        $unreturnedBooks = $this->quantity - $this->returned_quantity;

        if ($unreturnedBooks <= 0 && $this->status === 'returned') {
            return $this->fine_amount; // Return the saved fine amount if already fully returned
        }

        // If already returned at some point (even partially)
        if ($this->return_date && $this->return_date->gt($this->due_date)) {
            $overdueDays = ceil($this->due_date->diffInHours($this->return_date) / 24);
            if ($overdueDays == 0) $overdueDays = 1;
            
            // If it's a non-returned status, it's currently being calculated live
            if ($this->status !== 'returned') {
                $overdueDaysLive = ceil($this->due_date->diffInHours($now) / 24);
                if ($overdueDaysLive == 0) $overdueDaysLive = 1;
                return 10 * $overdueDaysLive * $unreturnedBooks;
            }
        }

        // If not returned, calculate based on today's date
        if ($unreturnedBooks > 0 && $now->gt($this->due_date)) {
            $overdueDays = ceil($this->due_date->diffInHours($now) / 24);
            if ($overdueDays == 0) $overdueDays = 1;
            return 10 * $overdueDays * $unreturnedBooks;
        }

        return 0;
    }

    /**
     * Check if borrowing is overdue.
     */
    public function isOverdue(): bool
    {
        $booksNotReturned = $this->quantity - $this->returned_quantity;
        return $booksNotReturned > 0 && Carbon::now()->gt($this->due_date);
    }

    /**
     * Get overdue days count.
     */
    public function getOverdueDays(): int
    {
        if ($this->return_date) {
            return max(0, $this->due_date->diffInDays($this->return_date));
        }
        return max(0, $this->due_date->diffInDays(Carbon::now()));
    }
}
