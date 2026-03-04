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
        // If already returned, calculate based on return date
        if ($this->return_date) {
            $overdueBooks = max(0, $this->quantity - $this->returned_quantity);
            if ($this->return_date->gt($this->due_date)) {
                $overdueDays = $this->due_date->diffInDays($this->return_date);
                return 10 * $overdueDays * $overdueBooks;
            }
            return 0;
        }

        // If not returned, calculate based on today's date
        $overdueBooks = max(0, $this->quantity - $this->returned_quantity);
        if (Carbon::now()->gt($this->due_date)) {
            $overdueDays = $this->due_date->diffInDays(Carbon::now());
            return 10 * $overdueDays * $overdueBooks;
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
