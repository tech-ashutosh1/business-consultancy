# business-consultancy

**Business Consulting Website (Laravel)**

This repository is a small Laravel application that demonstrates a business consultancy website with a public contact form and an admin dashboard that lists contact inquiries.

**Tech Stack:**
- **PHP 8 / Laravel**
- **MySQL**
- **Tailwind CSS / Vite**

**Quick Setup**

- **Clone:**

  git clone <repo-url>

- **Install PHP dependencies:**

  composer install

- **Install JS dependencies:**

  npm install

- **Environment:**

  Copy the environment example and set database credentials:

  cp .env.example .env
  # then edit .env DB_* values

- **App key:**

  php artisan key:generate

- **Migrate & Seed (adds test contacts):**

  php artisan migrate --seed

- **Build assets (dev):**

  npm run dev

- **Serve (dev):**

  php artisan serve

Visit http://127.0.0.1:8000 and log in (a test user is created by the seeder). The admin dashboard is available at `/dashboard` (protected by `auth`).

**Database & Seeders**

- The `contacts` table migration is at [database/migrations/2025_12_28_134610_create_contacts_table.php](database/migrations/2025_12_28_134610_create_contacts_table.php).
- Test contacts are added in the main seeder: [database/seeders/DatabaseSeeder.php](database/seeders/DatabaseSeeder.php) — running `php artisan db:seed` inserts sample contact inquiries so the dashboard shows data.

**Key Files**

- Routes: [routes/web.php](routes/web.php)
- Dashboard controller: [app/Http/Controllers/DashboardController.php](app/Http/Controllers/DashboardController.php)
- Contact model: [app/Models/Contact.php](app/Models/Contact.php)
- Dashboard view: [resources/views/dashboard.blade.php](resources/views/dashboard.blade.php)
- Contact form view: [resources/views/contact.blade.php](resources/views/contact.blade.php)

**Notes / Troubleshooting**

- If the dashboard is empty, ensure migrations and seeders have been run and that your `.env` DB settings are correct.
- To re-seed test data (will not reset existing data):

  php artisan db:seed

- To reset and re-seed (DESTRUCTIVE):

  php artisan migrate:fresh --seed

If you want, I can add a dedicated `contacts` factory and a small feature test that verifies the dashboard shows seeded contacts.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
# business-consultancy
