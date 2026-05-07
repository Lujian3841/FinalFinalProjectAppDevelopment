# Short Cutt LLC - Landscaping Website

A professional landscaping website built with PHP, HTML, CSS, and MySQL based on your wireframe design.

## Features

### User Authentication
- **Login/Signup System**: Users can create accounts or continue as guests
- **Session Management**: Secure session handling for logged-in users
- **Guest Access**: Browse the site without creating an account

### Pages

1. **Login Page (index.php)**
   - Username/password authentication
   - "Continue as Guest" option
   - Link to signup page

2. **Signup Page (signup.php)**
   - New user registration
   - Email validation
   - Password confirmation

3. **Home Page (home.php)**
   - Welcome message
   - Service showcase with 6 service cards
   - Navigation menu

4. **Estimates Page (estimates.php)**
   - Service type selection (Rock, Mulch, Lawn, Snow)
   - Total area input
   - Plants count
   - Tree removal count
   - Real-time total calculation
   - Save/Clear/Discard buttons
   - Only 1 estimate per logged-in user (as per wireframe)
   - Guest users can view but not save

5. **Contact Us Page (contact.php)**
   - Email input field
   - Message textarea
   - Form submission with database storage
   - Automatic email notifications (simulated)

6. **Thank You Page (thankyou.php)**
   - Confirmation message after contact form submission

## Setup Instructions

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- phpMyAdmin (optional, for database management)

### Installation

1. **Database Setup**
   ```bash
   # Create the database and tables
   mysql -u root -p < database.sql
   ```

2. **Configure Database Connection**
   - Open `config.php`
   - Update the database credentials if needed:
     ```php
     define('DB_HOST', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', 'your_password');
     define('DB_NAME', 'shortcutt_db');
     ```

3. **Deploy Files**
   - Copy all files to your web server's document root
   - For XAMPP: `C:/xampp/htdocs/shortcutt/`
   - For WAMP: `C:/wamp64/www/shortcutt/`
   - For MAMP: `/Applications/MAMP/htdocs/shortcutt/`

4. **Create Test User**
   - The database.sql includes a test user setup
   - Or create one through the signup page

5. **Access the Website**
   - Open browser and navigate to: `http://localhost/shortcutt/`

## File Structure

```
shortcutt/
├── index.php          # Login page
├── signup.php         # User registration
├── home.php           # Main landing page
├── estimates.php      # Estimate calculator
├── contact.php        # Contact form
├── thankyou.php       # Thank you page
├── logout.php         # Logout handler
├── config.php         # Database configuration
├── styles.css         # Main stylesheet
├── database.sql       # Database schema
└── README.md          # This file
```

## Database Schema

### Tables

1. **users**
   - id (Primary Key)
   - username
   - password (hashed)
   - email
   - created_at

2. **estimates**
   - id (Primary Key)
   - user_id (Foreign Key)
   - service_type
   - total_area
   - plants_count
   - tree_removal_count
   - total_cost
   - created_at
   - updated_at

3. **contact_messages**
   - id (Primary Key)
   - user_email
   - message
   - created_at

## Features Implemented from Wireframe

✅ Login/Signup system
✅ Guest access option
✅ Navigation menu (Estimates, Home, Contact Us)
✅ Estimate form with:
   - Service type selector (Rock, Mulch, Lawn, Snow)
   - Total area input
   - Plants count
   - Tree removal count
   - Real-time total calculation
   - Clear, Discard, and Save buttons
✅ Only 1 estimate per user (Save overwrites previous)
✅ Contact form with email and message
✅ Email notifications (simulated - ready for PHPMailer integration)
✅ Thank you page after contact submission
✅ User info display in header
✅ Responsive design

## Pricing Structure (Estimate Calculator)

- **Rock**: $5 per sq ft
- **Mulch**: $3 per sq ft
- **Lawn**: $2 per sq ft
- **Snow**: $4 per sq ft
- **Plants**: $25 each
- **Tree Removal**: $200 each

## Security Features

- Password hashing using PHP's password_hash()
- Prepared statements to prevent SQL injection
- Session management for user authentication
- Input validation and sanitization

## Email Functionality

The contact form currently simulates email sending. To enable real emails:

1. Install PHPMailer:
   ```bash
   composer require phpmailer/phpmailer
   ```

2. Update `contact.php` with SMTP configuration

## Browser Compatibility

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Responsive Design

The website is fully responsive and works on:
- Desktop (1200px+)
- Tablet (768px - 1199px)
- Mobile (< 768px)

## Future Enhancements

- Image upload for project photos
- Admin panel for managing estimates
- Payment integration
- Email verification
- Password reset functionality
- Service gallery
- Customer testimonials

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check database credentials in config.php
   - Ensure MySQL service is running
   - Verify database exists

2. **Cannot Save Estimates**
   - Make sure you're logged in (not guest)
   - Check database permissions

3. **Styles Not Loading**
   - Verify styles.css path is correct
   - Clear browser cache

## License

This project is created for Short Cutt LLC.

## Support

For issues or questions, contact through the website's contact form.
