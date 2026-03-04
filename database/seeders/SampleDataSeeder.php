<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user for librarian login
        User::firstOrCreate(
            ['email' => 'librarian@librarysystem.local'],
            [
                'name' => 'Librarian Admin',
                'password' => Hash::make('password123'),
            ]
        );

        // Create sample students
        Student::firstOrCreate(
            ['student_id' => '2024001'],
            [
                'name' => 'Juan Dela Cruz',
                'email' => 'juan.delacruz@student.edu',
                'phone' => '+63912345678',
                'address' => '123 Main St, Metro Manila',
            ]
        );

        Student::firstOrCreate(
            ['student_id' => '2024002'],
            [
                'name' => 'Maria Santos',
                'email' => 'maria.santos@student.edu',
                'phone' => '+63913456789',
                'address' => '456 Oak Ave, Quezon City',
            ]
        );

        Student::firstOrCreate(
            ['student_id' => '2024003'],
            [
                'name' => 'Pedro Reyes',
                'email' => 'pedro.reyes@student.edu',
                'phone' => '+63914567890',
                'address' => '789 Pine Rd, Makati',
            ]
        );

        // Create sample authors
        $author1 = Author::firstOrCreate(
            ['name' => 'Jose Rizal'],
            ['biography' => 'Philippines national hero, polymath, and writer. Known for his novels "Noli Me Tangere" and "El Filibusterismo".']
        );

        $author2 = Author::firstOrCreate(
            ['name' => 'Gabriela Silang'],
            ['biography' => 'First female and Asian revolutionary general who led an uprising against colonial rule.']
        );

        $author3 = Author::firstOrCreate(
            ['name' => 'Bienvenido Santos'],
            ['biography' => 'Prominent Filipino writer and poet, known for his short story collections and novels.']
        );

        $author4 = Author::firstOrCreate(
            ['name' => 'Emilio Jacinto'],
            ['biography' => 'Filipino revolutionary leader, military strategist, and intellectual of the Philippine Revolution.']
        );

        // Create sample books
        $book1 = Book::firstOrCreate(
            ['isbn' => '978-1234567890'],
            [
                'title' => 'Noli Me Tangere',
                'description' => 'A novel by Jose Rizal depicting the struggles of the Filipino people under Spanish rule.',
                'publisher' => 'Philippine Publishers Inc.',
                'published_year' => 1887,
                'quantity' => 5,
                'available_count' => 5,
            ]
        );
        $book1->authors()->syncWithoutDetaching($author1->id);

        $book2 = Book::firstOrCreate(
            ['isbn' => '978-1234567891'],
            [
                'title' => 'El Filibusterismo',
                'description' => 'The sequel to Noli Me Tangere, continuing the story of reform and revolution.',
                'publisher' => 'Philippine Publishers Inc.',
                'published_year' => 1891,
                'quantity' => 4,
                'available_count' => 4,
            ]
        );
        $book2->authors()->syncWithoutDetaching($author1->id);

        $book3 = Book::firstOrCreate(
            ['isbn' => '978-1234567892'],
            [
                'title' => 'The Scent of Apples',
                'description' => 'A collection of short stories by Bienvenido Santos about Filipino immigrants.',
                'publisher' => 'International Publishers',
                'published_year' => 1956,
                'quantity' => 3,
                'available_count' => 3,
            ]
        );
        $book3->authors()->syncWithoutDetaching($author3->id);

        $book4 = Book::firstOrCreate(
            ['isbn' => '978-1234567893'],
            [
                'title' => 'Philippine History and Government',
                'description' => 'A comprehensive study of Philippine history, government systems, and national development.',
                'publisher' => 'Educational Press Philippines',
                'published_year' => 2020,
                'quantity' => 6,
                'available_count' => 6,
            ]
        );
        $book4->authors()->syncWithoutDetaching([$author2->id, $author4->id]);
    }
}
