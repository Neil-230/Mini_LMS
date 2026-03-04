<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'student_id',
        'email',
        'phone',
        'address',
    ];

    /**
     * Get all borrowings for this student.
     */
    public function borrowings(): HasMany
    {
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Get all books borrowed by this student.
     */
    public function books()
    {
        return $this->hasManyThrough(Book::class, Borrowing::class);
    }
}
