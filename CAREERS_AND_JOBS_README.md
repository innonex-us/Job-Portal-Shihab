# Careers & Jobs - Laravel Application

This Laravel application is a migration of a static HTML/JS site into a fully functional Laravel application with admin panel.

## Features

### Public Site
- Home page with ZIP code input form
- User information collection form
- Background check verification page
- Data collection and storage in database

### Admin Panel
- Secure admin login
- Dashboard with statistics
- User management
- View user details and verification status

## Installation

1. Clone the repository
2. Run `composer install`
3. Set up your `.env` file with database credentials
4. Run `php artisan migrate --seed`
5. Run `npm install && npm run dev`
6. Access the site at `http://localhost:8000`
7. Access the admin panel at `http://localhost:8000/admin`

## Admin Credentials
- Email: admin@admin.com
- Password: admin123

## Project Structure

- Models:
  - UserProfile: Stores user information
  - BackgroundCheck: Stores verification information
  - Zipcode: Stores ZIP code entries

- Controllers:
  - ZipcodeController: Handles ZIP code collection
  - UserProfileController: Handles user information collection
  - BackgroundCheckController: Handles background check verification
  - Admin/DashboardController: Handles admin dashboard
  - Admin/UserController: Handles user management in admin

## Technologies Used
- Laravel 12
- Bootstrap 5
- MySQL/SQLite database
- Modern JavaScript

## Flow
1. User inputs ZIP code on home page
2. User provides personal information on info page
3. User completes background check verification
4. All data is stored and viewable in admin panel
