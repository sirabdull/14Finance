# 14Finance - Quick Setup Guide

## System Requirements
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL 5.7+
- Web browser (Chrome, Firefox, Edge recommended)

## Quick Start (Step by Step)

### 1. Install Dependencies

Open terminal in project directory and run:

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Configure Database

Edit the `.env` file and update these lines:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=14finance
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

### 4. Create Database

Open MySQL command line:

```sql
CREATE DATABASE 14finance;
EXIT;
```

Or use phpMyAdmin/MySQL Workbench to create a database named `14finance`

### 5. Run Migrations & Seeders

```bash
# Create database tables
php artisan migrate

# Seed demo data (creates 3 test accounts)
php artisan db:seed
```

### 6. Build Frontend Assets

Choose one:

```bash
# For production (one-time build)
npm run build

# OR for development (watch for changes)
npm run dev
```

### 7. Start Application

```bash
php artisan serve
```

Visit: **http://localhost:8000**

## Demo Login Credentials

After running `php artisan db:seed`, use any of these accounts:

| Email | Password | Features |
|-------|----------|----------|
| john@14finance.com | password | Has sample transactions |
| jane@14finance.com | password | Empty account |
| michael@14finance.com | password | Empty account |

You can also login using the **account number** shown after seeding instead of email.

## Features to Test

### ✅ Login
- Login with email or account number
- Password: `password`

### ✅ Dashboard
- View account balance
- Hide/show balance
- View recent transactions
- Quick action buttons

### ✅ Transfer Funds
1. Click "Transfer Funds"
2. Enter another user's account number
3. Click "Verify"
4. Enter amount and optional note
5. Click "Transfer"

### ✅ Pay Bills
1. Click "Pay Bills"
2. Choose bill type (Electricity/Water/Internet)
3. Enter meter/customer number
4. Enter amount
5. Click "Pay"

### ✅ Transaction History
- View all transactions
- Filter by type (credit/debit)
- Filter by category
- Search transactions
- Pagination

## Troubleshooting

### Issue: "Target class [LoginController] does not exist"
**Solution**: Run `composer dump-autoload`

### Issue: Database connection error
**Solution**: 
1. Check MySQL is running
2. Verify database credentials in `.env`
3. Ensure database `14finance` exists

### Issue: Assets not loading
**Solution**: 
1. Run `npm run build` or `npm run dev`
2. Clear browser cache
3. Run `php artisan cache:clear`

### Issue: "Class 'Account' not found"
**Solution**: Run `composer dump-autoload`

### Issue: CSRF token mismatch
**Solution**: 
1. Clear browser cookies
2. Run `php artisan config:clear`
3. Restart the server

## Testing Transfer Between Accounts

1. Login as **john@14finance.com**
2. Note Jane's account number from seeder output
3. Go to "Transfer Funds"
4. Enter Jane's account number
5. Verify recipient
6. Enter amount (e.g., 5000)
7. Complete transfer
8. Logout and login as **jane@14finance.com**
9. Check dashboard - you should see the received amount

## Project Features Summary

✅ **Authentication**
- Login with email or account number
- Secure password hashing
- Session management
- Logout functionality

✅ **Dashboard**
- Account summary
- Balance visibility toggle
- Recent transactions
- Quick actions

✅ **Fund Transfer**
- Account verification
- Balance validation
- Real-time updates
- Transaction history

✅ **Bill Payment**
- Electricity bills
- Water bills
- Internet/TV bills
- Multiple providers

✅ **Transaction History**
- Complete transaction log
- Advanced filtering
- Search functionality
- Pagination

✅ **Security**
- CSRF protection
- SQL injection prevention
- XSS protection
- Secure sessions
- Transaction rollback

## Development Commands

```bash
# Clear all caches
php artisan optimize:clear

# Run migrations fresh (⚠️ deletes all data)
php artisan migrate:fresh --seed

# View routes
php artisan route:list

# Run tests (if tests are added)
php artisan test

# Start development server
php artisan serve

# Build assets for development
npm run dev

# Build assets for production
npm run build
```

## File Structure Overview

```
14Finance/
├── app/
│   ├── Livewire/          # Livewire components
│   │   ├── Auth/          # Login/Logout
│   │   └── Dashboard/     # All dashboard features
│   ├── Models/            # Database models
│   │   ├── User.php
│   │   ├── Account.php
│   │   └── Transaction.php
│
├── database/
│   ├── migrations/        # Database schema
│   └── seeders/          # Demo data
│
├── resources/
│   ├── views/
│   │   ├── components/layouts/  # App & guest layouts
│   │   └── livewire/           # Component views
│   ├── css/
│   └── js/
│
├── routes/
│   └── web.php           # Application routes
│
└── public/               # Public assets
```

## Contact & Support

This is a university project by **Group 14**

For issues or questions, contact the development team.

---

© 2026 14Finance | Group 14 Banking Platform
