# Mini Library Management System

<p align="center">
  <img src="https://img.icons8.com/color/96/library.png" alt="Library Management System" width="120">
</p>

A modern Library Management System built with Laravel 12 and Tailwind CSS v4. This application provides comprehensive functionality for managing books, students, authors, and borrowing transactions in an educational institution setting.

## 🚀 Features

- **📚 Book Management** - Add, edit, delete, and track book inventory
- **👨‍🎓 Student Management** - Manage student records and information
- **✍️ Author Management** - Maintain author database and book associations
- **📋 Borrowing System** - Track book loans, returns, and fines
- **📊 Dashboard** - Real-time statistics and overview
- **🔍 Search & Filter** - Advanced search capabilities
- **📱 Responsive Design** - Modern UI that works on all devices
- **🎨 Beautiful UI** - Glass morphism design with Tailwind CSS

## 🛠️ Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Blade Templates with Tailwind CSS v4
- **Database**: MySQL
- **UI Framework**: Bootstrap 5 + Custom Glass Morphism
- **Icons**: Font Awesome 6
- **Build Tool**: Vite

## 📸 Screenshots

### Dashboard
![Dashboard](https://via.placeholder.com/800x400/4f46e5/ffffff?text=Dashboard+Overview)

### Book Management
![Books](https://via.placeholder.com/800x400/06b6d4/ffffff?text=Book+Management)

### Student Management  
![Students](https://via.placeholder.com/800x400/10b981/ffffff?text=Student+Management)

## 🚀 Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL Database

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Neil-230/Mini_LMS.git
   cd Mini_LMS
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run migrations**
   ```bash
   php artisan migrate
   ```

5. **Start development server**
   ```bash
   npm run dev
   php artisan serve
   ```

## 📁 Project Structure

```
Mini_LMS/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── books/
│   │   ├── students/
│   │   └── ...
│   └── css/
├── database/
│   ├── migrations/
│   └── ...
└── ...
```

## 🎯 Main Modules

### 📚 Books Module
- CRUD operations for books
- ISBN tracking
- Quantity management
- Author associations
- Category support

### 👨‍🎓 Students Module  
- Student registration
- Profile management
- Borrowing history
- Contact information

### ✍️ Authors Module
- Author profiles
- Book associations
- Biography management

### 📋 Borrowing Module
- Book checkout/check-in
- Due date tracking
- Fine calculation
- History tracking

## 🎨 UI Features

- **Glass Morphism Design**: Modern frosted glass effect
- **Responsive Layout**: Mobile-first approach
- **Dark/Light Mode**: Easy theme switching
- **Smooth Animations**: Hover effects and transitions
- **Interactive Charts**: Data visualization
- **Search Interface**: Live search functionality

## 📊 Database Schema

The application uses the following main tables:
- `books` - Book information
- `students` - Student records  
- `authors` - Author data
- `borrowings` - Transaction records
- `users` - User accounts

## 🔧 Configuration

Key configuration files:
- `.env` - Environment variables
- `config/database.php` - Database settings
- `vite.config.js` - Build configuration

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Support

For support and questions:
- Create an issue in the repository
- Check existing documentation
- Review the FAQ section

---

**Built with ❤️ using Laravel 12 and modern web technologies**
