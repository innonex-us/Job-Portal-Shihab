# Local Development Setup Guide

This guide explains how to set up this Laravel application for local development.

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js and NPM
- SQLite or MySQL/MariaDB database
- Git (optional but recommended)

## Installation Steps

### 1. Clone the Repository (or extract the ZIP archive)

```bash
git clone [repository-url] Shihab-vai-laravel
cd Shihab-vai-laravel
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Set Up the Environment File

```bash
cp .env.example .env
php artisan key:generate
```

Edit the `.env` file to configure your database:

For SQLite:
```
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/Shihab-vai-laravel/database/database.sqlite
```

For MySQL:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shihab_laravel
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Create the Database

For SQLite:
```bash
touch database/database.sqlite
```

For MySQL:
```bash
mysql -u root -p
```
```sql
CREATE DATABASE shihab_laravel;
EXIT;
```

### 5. Run Migrations and Seeders

```bash
php artisan migrate
php artisan db:seed
```

### 6. Install Front-end Dependencies (if needed)

```bash
npm install
npm run dev
```

### 7. Start the Development Server

```bash
php artisan serve
```

Your application will now be running at `http://localhost:8000`

## Admin Access

After running the seeders, an admin user will be created with the following credentials:

- **Email**: admin@example.com
- **Password**: password

You can access the admin panel at `http://localhost:8000/bd/system/admin`

## Available Routes

- `/` - Home/zipcode page
- `/user-info` - User information form
- `/background-check` - Background check verification
- `/bd/system/admin` - Admin dashboard
- `/bd/system/admin/users` - User management
- `/bd/system/admin/settings` - Application settings

## Development Commands

- `php artisan migrate:fresh --seed` - Reset the database and run all seeders
- `php artisan make:controller YourController` - Create a new controller
- `php artisan make:model YourModel -m` - Create a new model with migration
- `php artisan serve --port=8080` - Run the development server on a custom port

## Troubleshooting

### Permission Issues with Storage or Cache

```bash
chmod -R 775 storage bootstrap/cache
```

### Migration Issues

If you encounter migration issues, try:

```bash
php artisan config:clear
php artisan cache:clear
php artisan migrate:fresh
```

### Composer Dependency Issues

```bash
composer dump-autoload
```

### Node.js/NPM Issues

If you encounter issues with front-end assets, try:

```bash
rm -rf node_modules
npm cache clean --force
npm install
npm run dev
```

## Project Structure Overview

- `app/` - Core application code
  - `Http/Controllers/` - Application controllers
  - `Models/` - Eloquent models
- `database/` - Migrations and seeders
- `resources/` - Views and assets
  - `views/` - Blade templates
- `routes/` - Application routes
- `public/` - Publicly accessible files
- `storage/` - Application storage

## Additional Information

For any questions or issues, please refer to the official Laravel documentation at https://laravel.com/docs or contact the development team.
