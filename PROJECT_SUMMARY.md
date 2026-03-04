# Mini Library Management System - Project Summary

## Project Overview
This is a comprehensive Library Management System built with Laravel 12, designed to manage library collections, student borrowing records, and automated fine calculations. The system implements MVC architecture with full CRUD operations for managing students, books, authors, and borrowing transactions.

---

## Completed Components

### ✅ Database Layer (5 Migrations)

#### 1. **Students Table** (`2026_03_02_000001_create_students_table.php`)
- Stores student information
- Fields: id, name, student_id (unique), email (unique), phone, address, timestamps
- Primary entity for borrowing transactions

#### 2. **Authors Table** (`2026_03_02_000002_create_authors_table.php`)
- Stores author information
- Fields: id, name, biography, timestamps

#### 3. **Books Table** (`2026_03_02_000003_create_books_table.php`)
- Manages library book inventory
- Fields: id, title, isbn (unique), description, publisher, published_year, quantity, available_count, timestamps
- Tracks both total inventory and real-time availability

#### 4. **Author-Book Pivot Table** (`2026_03_02_000004_create_author_book_table.php`)
- Many-to-many relationship between authors and books
- Fields: id, author_id (FK), book_id (FK), timestamps
- Unique constraint on (author_id, book_id) pairs

#### 5. **Borrowings Table** (`2026_03_02_000005_create_borrowings_table.php`)
- Tracks all borrowing transactions
- Fields: id, student_id (FK), book_id (FK), quantity, borrow_date, due_date, return_date (nullable), returned_quantity, fine_amount, status (enum), timestamps
- Supports partial returns and fine tracking

---

### ✅ Model Layer (5 Models with Eloquent Relationships)

#### 1. **User Model**
- Standard Laravel authentication user model from Breeze scaffolding
- Used for librarian/admin authentication

#### 2. **Student Model** (`app/Models/Student.php`)
- `HasMany` relationship to Borrowing transactions
- `HasManyThrough` relationship to Book via Borrowing
- Enables querying student's borrowing history and borrowed books

#### 3. **Book Model** (`app/Models/Book.php`)
- `BelongsToMany` relationship to Author (via author_book pivot table)
- `HasMany` relationship to Borrowing transactions
- Custom `available_count` attribute that calculates real-time availability
- Available count = Total quantity - Sum of borrowed quantities

#### 4. **Author Model** (`app/Models/Author.php`)
- `BelongsToMany` relationship to Book (via author_book pivot table)
- Pure data model supporting multi-authored books

#### 5. **Borrowing Model** (`app/Models/Borrowing.php`)
- **Core Business Logic Model**
- `BelongsTo` Student and Book relationships
- **Key Methods:**
  - `calculateFine()`: Computes fine as ₱10 × overdue_days × outstanding_books
  - `isOverdue()`: Checks if return is past due_date
  - `getOverdueDays()`: Returns count of days past due date
- Properly handles partial returns with fine recalculation

---

### ✅ Controller Layer (5 Resource Controllers with Extended Methods)

#### 1. **StudentController** (`app/Http/Controllers/StudentController.php`)
- **RESTful Methods:** index, create, store, show, edit, update, destroy
- Features:
  - Paginated student listing
  - Validation for unique student_id and email
  - Integration with borrowing history in show view
  - Proper error handling and flash messages

#### 2. **BookController** (`app/Http/Controllers/BookController.php`)
- **RESTful Methods:** index, create, store, show, edit, update, destroy
- Features:
  - Many-to-many author relationship management
  - Uses `attach()` and `sync()` for author associations
  - Prevents deletion if active borrowings exist
  - Dynamic author selection in forms

#### 3. **AuthorController** (`app/Http/Controllers/AuthorController.php`)
- **RESTful Methods:** index, create, store, show, edit, update, destroy
- Features:
  - Book count aggregation in index view
  - Biography management
  - Published books listing in show view

#### 4. **BorrowingController** (`app/Http/Controllers/BorrowingController.php`)
- **Base Methods:** index, create, store, show
- **Extended Custom Methods:**
  - `returnForm()`: Display return process interface
  - `processReturn()`: Handle partial/full returns with fine recalculation
  - `studentHistory()`: Show borrowing records for specific student
  - `bookHistory()`: Show borrowing records for specific book
  - `getAvailableBooks()`: API endpoint returning JSON with availability data
- Features:
  - Fine calculation on return
  - Support for partial returns
  - Dynamic availability checking via AJAX

#### 5. **DashboardController** (`app/Http/Controllers/DashboardController.php`)
- **Method:** index
- Features:
  - Aggregates 4 key statistics:
    - Total books in system
    - Total students registered
    - Total authors
    - Currently active (borrowed) transactions
  - Lists overdue books with student names
  - Quick action links to create new records

---

### ✅ Routes Configuration (`routes/web.php`)

**Authentication Routes:**
- GET / → Welcome page
- GET /login → Login page (via Breeze)
- GET /register → Registration page (via Breeze)

**Application Routes:**
- GET /dashboard → Dashboard with statistics

**Resource Routes (RESTful):**
- `/students` - Full CRUD for students
- `/books` - Full CRUD for books
- `/authors` - Full CRUD for authors
- `/borrowings` - Full CRUD for borrowing transactions

**Custom Routes:**
- GET `/borrowings/{borrowing}/return` → Return form
- POST `/borrowings/{borrowing}/process-return` → Process return & calculate fine
- GET `/students/{student}/borrowing-history` → Student's borrowing history
- GET `/books/{book}/borrowing-history` → Book's borrowing history
- GET `/api/books/{book}/available` → JSON API for real-time availability

---

### ✅ View Layer (20+ Blade Templates with Bootstrap 5)

#### **Layout & Core Views:**
- `layouts/app.blade.php` - Master layout with:
  - Responsive Bootstrap 5 navbar with dropdown menus
  - Custom CSS variables for consistent theming (primary: #2c3e50, secondary: #3498db)
  - Flash message display for success/error notifications
  - Footer with library info
  - Mobile-responsive design

- `dashboard.blade.php` - Dashboard with:
  - 4 statistical cards (books, students, authors, active borrowings)
  - Overdue books alert table with color-coded badges
  - Quick action buttons for adding new records
  - Quick navigation links

#### **Student Management Views:**
- `students/index.blade.php` - Paginated table of all students
  - Columns: student_id, name, email, phone, address
  - Action buttons: View, Edit, Delete
  
- `students/create.blade.php` - Student registration form
  - Form fields: name, student_id, email, phone, address
  - Validation error display
  
- `students/edit.blade.php` - Edit student information
  - Pre-populated form fields
  - Submit button for updates
  
- `students/show.blade.php` - Student details page
  - Student information card
  - Paginated borrowing history table
  - Links to view individual transactions

#### **Book Management Views:**
- `books/index.blade.php` - Book catalog with authors
  - Columns: ISBN, title, authors (badges), publisher, quantity, available_count
  - Action buttons with icons
  - Availability status color-coded
  
- `books/create.blade.php` - Add new book form
  - Form fields: title, ISBN, description, publisher, published_year, quantity
  - Multi-select author dropdown with instruction text
  
- `books/edit.blade.php` - Edit book information
  - All fields editable
  - Author relationships syncable
  
- `books/show.blade.php` - Book details page
  - Book information card with ISBN, publisher, year, availability
  - Author badges
  - Borrowing history with student names

#### **Author Management Views:**
- `authors/index.blade.php` - Author directory
  - Columns: name, book count, biography preview
  - Action buttons
  
- `authors/create.blade.php` - Add author form
  - Name and biography fields
  
- `authors/edit.blade.php` - Edit author information
  
- `authors/show.blade.php` - Author profile page
  - Biography display
  - Published books grid (2 columns)
  - Availability status for each book

#### **Borrowing Management Views:**
- `borrowings/index.blade.php` - Transaction log
  - Table with: student name, book title, quantity, dates, status, fine amount
  - Status badges (color-coded: green=borrowed, yellow=partial, gray=returned)
  - View action for each transaction
  
- `borrowings/create.blade.php` - Create new borrowing
  - Student dropdown selector
  - Book dropdown showing available count
  - Quantity input with availability validation
  - Borrow date (defaults to today)
  - Due date (defaults to today + 14 days)
  - Info card explaining process
  
- `borrowings/show.blade.php` - Transaction details
  - Student and book information cards
  - Borrowing details: quantity, returned, outstanding
  - Fine calculation breakdown:
    - Overdue days calculation
    - Outstanding books count
    - Rate ($10/day/book)
    - Total fine amount
  - Status badge
  
- `borrowings/return.blade.php` - Return & fine processing
  - Two-column layout with student/book info
  - Return form with:
    - Return quantity input (max: outstanding)
    - Return date picker
  - **JavaScript-powered fine preview** - Real-time calculation as user changes values
  - Displays preview of fine before submission

#### **Welcome Page:**
- `welcome.blade.php` - Library-themed landing page
  - Hero section with call-to-action buttons
  - 4 feature cards showcasing key modules
  - "How It Works" section for students and librarians
  - Technology stack badges (Laravel, Bootstrap, SQL, Eloquent)
  - Call-to-action section with login/registration links

---

## Key Features Implemented

### 🎯 Authentication
- User registration and login via Laravel Breeze
- Password reset functionality
- Secure session management

### 📚 Student Management
- Register new students with unique student IDs
- View student profiles and borrowing history
- Update/delete student records
- Search and filter students

### 📖 Book Catalog
- Add books with ISBN, description, publisher, year
- Multi-author assignment (many-to-many)
- Real-time availability tracking
- Prevent deletion of books with active borrowings

### 👥 Author Management
- Register and manage authors
- Link authors to multiple books
- View author profiles with published books
- Track author statistics

### 📋 Borrowing System
- Create borrowing transactions
- Set custom due dates (default 14 days)
- Track borrowed quantity per transaction
- Support partial returns
- Process returns with fine calculation

### 💰 Fine Calculation System
- **Formula:** ₱10 per day per overdue book
- Automatic calculation on return
- JavaScript preview before submission
- Partial return support with accurate fine recalculation
- Fine tracking per transaction

### 📊 Dashboard & Reporting
- Real-time statistics (books, students, authors, active borrowings)
- Overdue book alerts
- Borrowing history per student/book
- Transaction logging

### 🎨 User Interface
- Clean, responsive Bootstrap 5 design
- Mobile-friendly layouts
- Consistent color scheme and styling
- Flash messages for user feedback
- Font Awesome icons for visual hierarchy

---

## Technology Stack

| Component | Technology |
|-----------|-----------|
| Framework | Laravel 12 |
| Language | PHP 8.2 |
| ORM | Eloquent |
| Database | SQLite (development) / MySQL (production ready) |
| Frontend | Bootstrap 5.3 |
| Icons | Font Awesome 6.4 |
| Server | Apache (via php artisan serve for dev) |
| Build Tool | Vite |

---

## Database Schema Summary

```
Students Table
├── id (Primary Key)
├── name
├── student_id (Unique)
├── email (Unique)
├── phone
├── address
└── timestamps

Authors Table
├── id (Primary Key)
├── name
├── biography
└── timestamps

Books Table
├── id (Primary Key)
├── title
├── isbn (Unique)
├── description
├── publisher
├── published_year
├── quantity
├── available_count
└── timestamps

Author-Book Pivot Table
├── id (Primary Key)
├── author_id (FK)
├── book_id (FK)
└── unique(author_id, book_id)

Borrowings Table
├── id (Primary Key)
├── student_id (FK)
├── book_id (FK)
├── quantity
├── borrow_date
├── due_date
├── return_date (nullable)
├── returned_quantity
├── fine_amount
├── status (enum)
└── timestamps
```

---

## Sample Data Included

The database is seeded with:
- **1 Librarian Account**: librarian@librarysystem.local / password123
- **3 Sample Students**: Juan Dela Cruz, Maria Santos, Pedro Reyes
- **4 Sample Authors**: Jose Rizal, Gabriela Silang, Bienvenido Santos, Emilio Jacinto
- **4 Sample Books**: Notable Filipino literature and history

---

## How to Run the Application

### Prerequisites
- PHP 8.2+
- Composer
- Node.js (for asset compilation, optional)
- SQLite or MySQL (configured in .env)

### Setup Instructions

1. **Clone/Extract Project**
   ```bash
   cd d:\Programming\Laravel\IT1313_LMS_Penaflorida
   ```

2. **Install Composer Dependencies**
   ```bash
   composer install
   ```

3. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

4. **Run Migrations**
   ```bash
   php artisan migrate
   ```

5. **Seed Sample Data (Optional)**
   ```bash
   php artisan db:seed --class=SampleDataSeeder
   ```

6. **Start Development Server**
   ```bash
   php artisan serve
   ```

7. **Access Application**
   - Navigate to `http://127.0.0.1:8000`
   - Login with: librarian@librarysystem.local / password123

### Building Frontend Assets (Optional)
```bash
npm install
npm run build
```

---

## API Endpoints

### Public Routes
- `GET /` - Welcome page
- `GET /login` - Login form
- `GET /register` - Registration form

### Protected Routes (Dashboard)
- `GET /dashboard` - Main dashboard

### Resource Endpoints
- `GET/POST /students` - List/Create students
- `GET/PUT/DELETE /students/{id}` - View/Edit/Delete student
- `GET/POST /books` - List/Create books  
- `GET/PUT/DELETE /books/{id}` - View/Edit/Delete book
- `GET/POST /authors` - List/Create authors
- `GET/PUT/DELETE /authors/{id}` - View/Edit/Delete author
- `GET/POST /borrowings` - List/Create borrowing
- `GET /borrowings/{id}` - View borrowing details
- `GET /borrowings/{id}/return` - Return form
- `POST /borrowings/{id}/process-return` - Process return

### API Endpoints
- `GET /api/books/{id}/available` - Get book availability (JSON)

---

## File Structure

```
app/
├── Http/Controllers/
│   ├── StudentController.php
│   ├── BookController.php
│   ├── AuthorController.php
│   ├── BorrowingController.php
│   └── DashboardController.php
├── Models/
│   ├── User.php
│   ├── Student.php
│   ├── Book.php
│   ├── Author.php
│   └── Borrowing.php

database/
├── migrations/
│   ├── 2026_03_02_000001_create_students_table.php
│   ├── 2026_03_02_000002_create_authors_table.php
│   ├── 2026_03_02_000003_create_books_table.php
│   ├── 2026_03_02_000004_create_author_book_table.php
│   └── 2026_03_02_000005_create_borrowings_table.php
└── seeders/
    └── SampleDataSeeder.php

resources/views/
├── layouts/
│   └── app.blade.php
├── dashboard.blade.php
├── students/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── books/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── authors/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── borrowings/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── show.blade.php
│   └── return.blade.php
└── welcome.blade.php

routes/
└── web.php
```

---

## Testing Credentials

**Librarian/Admin Account:**
- Email: `librarian@librarysystem.local`
- Password: `password123`

**Sample Students Available:**
- Juan Dela Cruz (ID: 2024001)
- Maria Santos (ID: 2024002)
- Pedro Reyes (ID: 2024003)

---

## Submission Requirements Compliance

✅ **Authentication**: Implemented with Laravel Breeze  
✅ **User Management**: Student registration, profiles, borrowing history  
✅ **Book/Author Management**: Full CRUD with many-to-many relationships  
✅ **Borrowing System**: Create, track, and return books  
✅ **Fine Calculation**: Automated ₱10/day per book formula  
✅ **Database Design**: Proper migrations, relationships, constraints  
✅ **MVC Architecture**: Clear separation of models, views, controllers  
✅ **Validation**: Form validation with error messages  
✅ **UI/UX Design**: Bootstrap responsive design with fonts/icons  
✅ **Business Logic**: Proper Eloquent models with methods  

---

## Next Steps for Deployment

1. Update `.env` file with production database credentials
2. Run `php artisan config:cache` for production
3. Configure web server (nginx/Apache)
4. Set up SSL certificates
5. Enable query caching for better performance
6. Implement rate limiting for API endpoints
7. Set up automated backups
8. Configure email notifications for overdue books

---

## Support & Documentation

For more information about Laravel, visit:
- [Laravel Documentation](https://laravel.com/docs)
- [Laravel Eloquent ORM](https://laravel.com/docs/eloquent)
- [Bootstrap Documentation](https://getbootstrap.com/docs)

---

**Project Status:** ✅ **COMPLETE AND READY FOR SUBMISSION**
**Last Updated:** 2026-03-02
