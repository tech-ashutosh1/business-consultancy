# Business Consultancy Website

A professional business consultancy website built with Laravel, featuring a public contact form and an admin dashboard for managing contact inquiries.

![Laravel](https://img.shields.io/badge/Laravel-11.x-red?style=flat-square&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat-square&logo=php)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-CSS-38B2AC?style=flat-square&logo=tailwind-css)

## 📋 Table of Contents

- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Prerequisites](#-prerequisites)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Usage](#-usage)
- [Project Structure](#-project-structure)
- [Database](#-database)
- [Testing](#-testing)
- [Troubleshooting](#-troubleshooting)
- [Contributing](#-contributing)
- [License](#-license)

## ✨ Features

- **Public Contact Form**: Visitors can submit inquiries through a user-friendly contact form
- **Admin Dashboard**: Secure dashboard to view and manage contact submissions
- **Authentication System**: Built-in Laravel authentication for admin access
- **Responsive Design**: Mobile-first design using Tailwind CSS
- **Database Seeding**: Pre-populated test data for development
- **Modern Build Tools**: Vite for fast asset compilation
- **Clean Architecture**: Following Laravel best practices

## 🛠 Tech Stack

- **Backend**: PHP 8.2+ / Laravel 11.x
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL 8.0+
- **Build Tool**: Vite
- **Package Manager**: Composer, NPM

## 📦 Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.2
- Composer
- Node.js >= 18.x
- NPM >= 9.x
- MySQL >= 8.0
- Git

## 🚀 Installation

Follow these steps to get your development environment running:

### 1. Clone the Repository

```bash
git clone https://github.com/tech-ashutosh1/business-consultancy.git
cd business-consultancy
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install JavaScript Dependencies

```bash
npm install
```

### 4. Environment Configuration

```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Database

Edit your `.env` file and update the database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=business_consultancy
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Create Database

```bash
# Create the database (MySQL)
mysql -u your_username -p
CREATE DATABASE business_consultancy;
exit;
```

### 7. Run Migrations and Seeders

```bash
# Run migrations to create tables
php artisan migrate

# Seed the database with test data
php artisan db:seed
```

### 8. Build Assets

```bash
# Development
npm run dev

# Production
npm run build
```

### 9. Start Development Server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

## ⚙️ Configuration

### Mail Configuration (Optional)

To enable email notifications for contact form submissions, configure your mail settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@businessconsultancy.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Cache Configuration

For better performance in production:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 💻 Usage

### Accessing the Application

- **Homepage**: `http://127.0.0.1:8000`
- **Contact Form**: `http://127.0.0.1:8000/contact`
- **Admin Dashboard**: `http://127.0.0.1:8000/dashboard` (requires authentication)
- **Login**: `http://127.0.0.1:8000/login`

### Default Test User

After running the seeder, you can log in with:

```
Email: test@example.com
Password: password
```

### Managing Contacts

1. Navigate to the dashboard after logging in
2. View all contact submissions in a paginated table
3. Filter and search through inquiries
4. Mark inquiries as read/unread (if implemented)

## 📁 Project Structure

```
business-consultancy/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── DashboardController.php
│   └── Models/
│       └── Contact.php
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   │   └── 2025_12_28_134610_create_contacts_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── public/
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── dashboard.blade.php
│       ├── contact.blade.php
│       └── layouts/
├── routes/
│   └── web.php
├── storage/
├── tests/
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── README.md
```

### Key Files

| File | Description |
|------|-------------|
| `routes/web.php` | Application routes |
| `app/Http/Controllers/DashboardController.php` | Dashboard logic |
| `app/Models/Contact.php` | Contact model |
| `resources/views/dashboard.blade.php` | Dashboard view |
| `resources/views/contact.blade.php` | Contact form view |
| `database/migrations/*_create_contacts_table.php` | Contacts table schema |

## 🗄️ Database

### Contacts Table Schema

```sql
CREATE TABLE contacts (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(255),
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Seeders

The `DatabaseSeeder.php` creates:
- Test user account for admin access
- Sample contact inquiries for dashboard testing

To re-seed the database:

```bash
# Seed without resetting
php artisan db:seed

# Reset and seed (⚠️ DESTRUCTIVE - removes all data)
php artisan migrate:fresh --seed
```

## 🧪 Testing

Run the test suite:

```bash
# Run all tests
php artisan test

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test --filter=ContactTest
```

### Writing Tests

Example feature test for the contact form:

```php
public function test_contact_form_submission()
{
    $response = $this->post('/contact', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'message' => 'Test inquiry'
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('contacts', [
        'email' => 'john@example.com'
    ]);
}
```

## 🔧 Troubleshooting

### Empty Dashboard

If the dashboard shows no data:

1. Verify database connection in `.env`
2. Run migrations: `php artisan migrate`
3. Run seeders: `php artisan db:seed`
4. Check database for records: `SELECT * FROM contacts;`

### Permission Errors

```bash
# Fix storage and cache permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### Asset Build Issues

```bash
# Clear npm cache
npm cache clean --force

# Remove node_modules and reinstall
rm -rf node_modules package-lock.json
npm install
```

### Database Connection Issues

- Verify MySQL is running: `sudo systemctl status mysql`
- Check credentials in `.env` match your MySQL user
- Ensure database exists: `SHOW DATABASES;`

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/AmazingFeature`
3. Commit your changes: `git commit -m 'Add some AmazingFeature'`
4. Push to the branch: `git push origin feature/AmazingFeature`
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👤 Author

**Ashutosh**

- GitHub: [@tech-ashutosh1](https://github.com/tech-ashutosh1)
- Repository: [business-consultancy](https://github.com/tech-ashutosh1/business-consultancy)

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - Utility-first CSS framework
- [Vite](https://vitejs.dev) - Next generation frontend tooling

---

⭐ If you find this project useful, please consider giving it a star!

For issues or questions, please [open an issue](https://github.com/tech-ashutosh1/business-consultancy/issues) on GitHub.