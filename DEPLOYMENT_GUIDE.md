# Laravel Application Deployment Guide for cPanel

This document provides a step-by-step guide to deploy this Laravel application to a cPanel hosting environment.

## Prerequisites

1. A cPanel hosting account with:
   - PHP 8.1+ support
   - MySQL or MariaDB database
   - SSH access (preferred but not mandatory)
   - Composer support (or ability to run Composer locally)

2. Access to your domain's DNS settings (for pointing domains/subdomains)

3. Your Laravel application codebase (Shihab-vai-laravel)

## Deployment Steps

### 1. Prepare Your Laravel Project for Production

Before uploading to cPanel, prepare your project locally:

```bash
# Navigate to your project directory
cd /Users/rokon-dev/Desktop/Personal-projects/Shihab-vai-laravel

# Install dependencies
composer install --optimize-autoloader --no-dev

# Optimize the application
php artisan optimize

# Compile assets (if using Laravel Mix/Vite)
npm run production # or npm run build
```

### 2. Create a Production `.env` File

Create a production version of your `.env` file:

```
APP_NAME="Careers & Jobs"
APP_ENV=production
APP_KEY=your-app-key-here
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your-mail-username
MAIL_PASSWORD=your-mail-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@your-domain.com
MAIL_FROM_NAME="${APP_NAME}"
```

> **Important**: Make sure to replace all placeholder values with your actual production values.

### 3. Set Up Your cPanel Account

#### 3.1. Create a New Database

1. Log in to your cPanel account
2. Navigate to "MySQL Databases" or "MariaDB Databases"
3. Create a new database (e.g., `username_careers`)
4. Create a new database user with a strong password
5. Add the user to the database with "All Privileges"
6. Note down the database name, username, and password

#### 3.2. Create a Subdomain (Optional)

If you want to host the application on a subdomain:

1. Navigate to "Subdomains" in cPanel
2. Create a new subdomain (e.g., `careers.yourdomain.com`)
3. Note the document root path provided by cPanel

### 4. Upload Your Application

#### Option 1: Using the File Manager

1. Go to "File Manager" in cPanel
2. Navigate to your domain's public_html folder (or subdomain folder)
3. Upload a ZIP archive of your Laravel application
4. Extract the ZIP archive
5. Rename or move files as needed

#### Option 2: Using FTP/SFTP (Recommended for Large Files)

1. Use an FTP client (FileZilla, Cyberduck, etc.)
2. Connect to your server using the FTP/SFTP credentials from cPanel
3. Upload your Laravel application files to the document root

### 5. Configure the Document Root

In standard cPanel setups, you need to point the document root to the `public` folder of your Laravel application.

#### Option 1: Using a Subdomain

If you created a subdomain, you can directly set its document root to the `public` folder during creation.

#### Option 2: Using .htaccess for Main Domain

Create or modify an `.htaccess` file in your main domain's root directory:

```apache
# Ensure this file is in the main public_html folder
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ Shihab-vai-laravel/public/$1 [L,QSA]
</IfModule>
```

#### Option 3: Using a Symbolic Link (Requires SSH Access)

```bash
# SSH into your server
ssh username@your-server

# Navigate to public_html
cd public_html

# Move Laravel's public directory content to public_html
cp -a Shihab-vai-laravel/public/. .

# Update index.php to point to the correct paths
# Edit index.php and update these lines:
# require __DIR__.'/../vendor/autoload.php';
# $app = require_once __DIR__.'/../bootstrap/app.php';

# To:
# require __DIR__.'/Shihab-vai-laravel/vendor/autoload.php';
# $app = require_once __DIR__.'/Shihab-vai-laravel/bootstrap/app.php';
```

### 6. Update Permissions

Set proper permissions for Laravel directories:

```bash
# SSH into your server
ssh username@your-server

# Navigate to your Laravel project
cd public_html/Shihab-vai-laravel

# Set permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;
chmod -R 775 storage bootstrap/cache
```

If you don't have SSH access, you can use cPanel's File Manager to change permissions.

### 7. Update the `.env` File

1. Upload your production `.env` file to the root of your Laravel application
2. Make sure to update:
   - APP_URL to your actual domain or subdomain
   - DB_DATABASE, DB_USERNAME, DB_PASSWORD with your cPanel database details
   - Generate a new APP_KEY if needed: `php artisan key:generate`

### 8. Run Migrations

#### Option 1: If Your Hosting Supports SSH

```bash
# SSH into your server
ssh username@your-server

# Navigate to your Laravel project
cd public_html/Shihab-vai-laravel

# Run migrations
php artisan migrate
php artisan db:seed
```

#### Option 2: If SSH is Not Available

1. Create a temporary migration route:

```php
// Add this to your routes/web.php temporarily
Route::get('/migrate-database', function () {
    if (app()->environment('production')) {
        $password = request()->query('password');
        if ($password !== 'your_secure_password_here') {
            return 'Unauthorized';
        }
        
        Artisan::call('migrate', ['--force' => true]);
        Artisan::call('db:seed', ['--force' => true]);
        
        return 'Migrations and seeders completed successfully';
    }
    
    return 'This command can only be run in production mode';
});
```

2. Visit `https://your-domain.com/migrate-database?password=your_secure_password_here`
3. **IMPORTANT**: Remove this route after migration is completed

### 9. Set Up a Cron Job for Laravel Scheduler

In cPanel:

1. Go to "Cron Jobs"
2. Add a new cron job that runs every minute:

```
* * * * * cd /home/username/public_html/Shihab-vai-laravel && php artisan schedule:run >> /dev/null 2>&1
```

Replace `/home/username/public_html/` with your actual path.

### 10. Set Up an Admin User (If not Created by Seeders)

If you need to create an admin user manually:

```bash
# SSH into your server
ssh username@your-server

# Navigate to your Laravel project
cd public_html/Shihab-vai-laravel

# Run tinker
php artisan tinker

# Create a new admin user
\App\Models\User::create([
    'name' => 'Admin User',
    'email' => 'admin@example.com',
    'password' => \Hash::make('strong-password-here'),
]);

# Exit tinker
exit
```

If SSH access is not available, consider adding a temporary secure route to create an admin user.

### 11. Final Configuration and Testing

1. Clear all caches on the production server:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

2. Test your application by visiting your domain in a web browser
3. Test the admin panel by visiting `https://your-domain.com/bd/system/admin`
4. Test form submissions and the entire user flow

## Troubleshooting Common Issues

### 1. 500 Server Error

Check the Laravel logs at `storage/logs/laravel.log` or server error logs in cPanel.

Common issues:
- Incorrect permissions on storage directory
- Missing .env file or APP_KEY
- Database connection issues

### 2. Page Not Found Errors

Usually related to URL rewriting:
- Check if mod_rewrite is enabled
- Verify .htaccess file is uploaded correctly
- Ensure proper routing configuration

### 3. Database Connection Issues

- Verify DB_HOST, DB_DATABASE, DB_USERNAME, DB_PASSWORD in .env
- Check if the database user has proper permissions

### 4. Asset Loading Issues

- Check if paths to assets are absolute or relative
- Ensure asset compilation worked correctly
- Verify if public directory is correctly set up

## Security Recommendations

1. Remove any development-specific files:
   - .git directory
   - README.md (or replace with a production version)
   - Any environment-specific configuration files

2. Ensure sensitive directories are not accessible:
   - Add proper .htaccess rules to protect sensitive folders

3. Set up HTTPS:
   - Use cPanel's "SSL/TLS" section to set up free Let's Encrypt certificates
   - Force HTTPS in your application

4. Regularly update your application:
   - Keep Laravel and all dependencies updated
   - Apply security patches promptly

## Maintenance and Updates

### Applying Updates

1. Create a backup of your files and database
2. Upload the new version of your application
3. Run migrations if needed
4. Clear caches

### Database Backups

1. In cPanel, navigate to "Backup Wizard" or "Backup"
2. Create regular backups of your database
3. Download and store backups securely

## Contact and Support

For assistance with deployment, contact:
- Your hosting provider's support team
- Your development team

## Conclusion

This Laravel application has been successfully set up for deployment to cPanel. Follow these instructions carefully to ensure a smooth production deployment. Regularly maintain and update your application to keep it secure and functioning optimally.

---

Document prepared on: May 23, 2025
