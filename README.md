# Careers & Jobs Portal

A Laravel-based job application portal with an admin panel that allows users to submit applications and administrators to manage users and application settings.

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-purple" alt="Bootstrap Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

## Features

- **User-Facing Pages**:
  - Zipcode validation and entry
  - User information submission form
  - Background check verification
  
- **Admin Panel**:
  - Dashboard with statistics and data visualization
  - User management system
  - Background check verification controls
  - Application settings management
  - Customizable verification URL and service name

## Technology Stack

- **Backend**: Laravel 10.x
- **Database**: MySQL/SQLite
- **Frontend**: HTML, CSS, JavaScript, Bootstrap 5
- **Authentication**: Laravel built-in authentication
- **Charts**: Chart.js

## Documentation

This repository includes several documentation files:

- [Installation Guide](./INSTALLATION.md) - How to set up the project locally
- [Deployment Guide](./DEPLOYMENT_GUIDE.md) - How to deploy to cPanel
- [Production Checklist](./PRODUCTION_CHECKLIST.md) - Pre-deployment checklist

## Getting Started

For quick setup, follow these steps:

1. Clone the repository
2. Run `composer install`
3. Configure the `.env` file
4. Run migrations with `php artisan migrate`
5. Create an admin user with `php artisan db:seed`
6. Start the server with `php artisan serve`

For detailed installation instructions, see [INSTALLATION.md](./INSTALLATION.md).

## Project Structure

- `/app` - Core application code
  - `/Http/Controllers` - Controllers for handling requests
  - `/Models` - Database models
- `/resources/views` - Blade templates
  - `/admin` - Admin panel views
  - `/layouts` - Layout templates
  - `/user-info`, `/zipcode`, `/background-check` - Public-facing views
- `/routes` - Route definitions
- `/database` - Migrations and seeders
- `/public` - Publicly accessible files and assets

## Routes

- `/` - Home page with zipcode entry
- `/user-info` - User information form
- `/background-check` - Background check verification
- `/bd/system/admin` - Admin dashboard
- `/bd/system/admin/users` - User management
- `/bd/system/admin/settings` - Application settings

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

Created on: May 23, 2025
