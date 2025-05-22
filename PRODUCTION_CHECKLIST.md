# Production Deployment Checklist

Use this checklist to ensure your Laravel application is ready for production deployment to cPanel.

## Code Optimization
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Run `composer install --optimize-autoloader --no-dev`
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Compile assets with production flag (`npm run production` or `npm run build`)

## Security
- [ ] Update `APP_KEY` with a secure value
- [ ] Remove any hard-coded credentials
- [ ] Verify all forms have CSRF protection
- [ ] Check user input validation on all forms
- [ ] Secure route protection with middleware
- [ ] Enable HTTPS
- [ ] Update passwords in `.env` to secure values
- [ ] Remove debug routes or temporary code
- [ ] Check file/directory permissions

## Database
- [ ] Remove any testing data
- [ ] Run migrations on production
- [ ] Seed necessary data
- [ ] Verify database credentials in `.env`
- [ ] Backup existing data before deployment

## Testing
- [ ] Test user registration flow
- [ ] Test admin login
- [ ] Test CRUD operations in admin panel
- [ ] Test all forms and validation
- [ ] Test responsive design on multiple devices
- [ ] Test site performance
- [ ] Test all admin settings functionality

## Final Checks
- [ ] Update service name via admin panel if needed
- [ ] Verify verification URL is correct
- [ ] Check all email addresses are correct
- [ ] Update any contact information
- [ ] Verify error logging is set up correctly
- [ ] Confirm cron jobs are set up for scheduled tasks
- [ ] Verify all assets load correctly
- [ ] Ensure all third-party services are configured

## Post-Deployment
- [ ] Monitor error logs
- [ ] Check server performance
- [ ] Verify backups are working
- [ ] Test the deployed application in production
- [ ] Update DNS records if needed

## Notes
* For the specific Laravel jobs application, make sure to check the background check verification flow
* Verify the service name and verification URL settings work correctly in production
* Ensure all assets (logos, icons) are displaying correctly
