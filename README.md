# MFC Car Management System

## Overview
This is a car auction website with an admin panel for managing vehicles. The system has been refactored to use centralized database configuration and separated files for better maintainability.

## File Structure

### Main Website Files
- `car-details.php` - Individual car details page
- `advance-search.php` - Car search results page
- `inc/header.php` - Main header includes
- `inc/footer.php` - Footer content
- `inc/car-head.php` - Header for car details pages
- `inc/search/search-head.php` - Header for search pages

### Admin Panel Files
- `admin/login.php` - Admin login page
- `admin/logout.php` - Admin logout
- `admin/dashboard.php` - Admin dashboard with statistics
- `admin/add-car.php` - Add new car form
- `admin/manage-cars.php` - List and manage all cars
- `admin/edit-car.php` - Edit existing car

### Configuration Files
- `config/database.php` - Centralized database configuration
- `inc/admin-header.php` - Admin panel header with navigation
- `inc/admin-footer.php` - Admin panel footer with scripts

## Database Configuration

The database connection is now centralized in `config/database.php`. To switch between local and live servers, simply comment/uncomment the appropriate configuration:

```php
// Local development
private $host = "localhost";
private $username = "root";
private $password = "";
private $dbname = "mfc";

// Live server (commented out)
// private $host = "sql105.infinityfree.com";
// private $username = "if0_41440777";
// private $password = "9dz5YU8vXnG";
// private $dbname = "if0_41440777_mfc";
```

## Admin Panel Access

1. Navigate to `/admin/login.php`
2. Login with:
   - Username: `admin`
   - Password: `admin123`
3. You'll be redirected to the dashboard

## Features

### Admin Panel
- **Dashboard**: View statistics and recent cars
- **Add Car**: Comprehensive form to add new vehicles
- **Manage Cars**: List, search, edit, and delete vehicles
- **Edit Car**: Update existing vehicle information
- **Responsive Design**: Works on desktop and mobile devices

### Car Management
- Add/edit complete vehicle information
- Image management (base name for multiple images)
- Search and pagination
- View cars on public site
- Form validation and error handling

## Image Naming Convention

Images should be named using the following pattern:
- `base_0.jpg` - Main image
- `base_1.jpg` - Additional image 1
- `base_2.jpg` - Additional image 2
- etc.

Where `base` is the image base name entered in the admin form (e.g., "30071").

## Database Table Structure

The system expects a `vehicles` table with the following fields:
- `id` (Primary Key)
- `year_model`
- `make`
- `model`
- `variant`
- `body_style`
- `doors`
- `fuel_type`
- `drive_type`
- `exterior`
- `interior`
- `odometer`
- `price`
- `stock`
- `vin`
- `announcements`
- `image` (base image name)
- `created_at`
- `updated_at`

## Security Notes

1. Change the default admin credentials in production
2. Implement proper session security
3. Add CSRF protection for forms
4. Validate and sanitize all user inputs
5. Use prepared statements to prevent SQL injection

## Usage

1. Update `config/database.php` with your database credentials
2. Ensure the `vehicles` table exists in your database
3. Upload car images to the `/image/` directory
4. Access the admin panel at `/admin/login.php`
5. Add cars using the "Add Car" form
6. View cars on the main website

## Recent Fixes

- Fixed image path duplication issues
- Separated database configuration for easy maintenance
- Created comprehensive admin panel
- Fixed magnific popup image loading
- Resolved slick slider conflicts
- Added proper form validation
- Implemented responsive design

## Support

For issues or questions, check the individual file comments or contact the development team.
