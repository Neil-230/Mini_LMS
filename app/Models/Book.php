<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'isbn',
        'description',
        'publisher',
        'published_year',
        'quantity',
        'available_count',
    ];

    /**
     * Get all authors for this book (Many-to-Many).
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'author_book');
    }

    /**
     * Get all borrowings for this book.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get the available count for this book.
     */
    public function getAvailableCountAttribute()
    {
        return $this->quantity - $this->borrowings()
            ->whereIn('status', ['borrowed', 'partially_returned'])
            ->sum('quantity') + 
            $this->borrowings()
            ->whereIn('status', ['borrowed', 'partially_returned'])
            ->sum('returned_quantity');
    }
}
