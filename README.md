# 14Finance - Banking Application

A professional web-based banking/fintech application developed by Group 14 for university project evaluation.

## Overview

14Finance is a secure, modern banking platform that provides essential banking features with a clean, professional interface designed to mimic real-world banking applications.

## Features

### 1. **Authentication**
- Secure login using account number or email
- Session-based authentication
- Password hashing (bcrypt)
- Logout functionality

### 2. **Dashboard**
- Personalized welcome message
- Account summary card (account number, type, balance)
- Privacy feature (show/hide balance)
- Quick action buttons
- Recent transactions overview

### 3. **Fund Transfer**
- Transfer money to other 14Finance accounts
- Recipient verification
- Real-time balance validation
- Transaction confirmation
- Secure database transactions

### 4. **Bill Payment**
- Pay electricity bills
- Pay water bills
- Pay internet/TV bills
- Multiple service providers
- Reference number tracking

### 5. **Transaction History**
- Complete transaction log
- Filter by type (credit/debit)
- Filter by category
- Search functionality
- Pagination support
- Detailed transaction information

## Technology Stack

- **Backend**: Laravel 11 (PHP)
- **Frontend**: Livewire 3, Alpine.js
- **Styling**: Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel Session-based

## Design Guidelines

- **Colors**: Deep blue (#1e3a8a), navy, charcoal
- **Background**: White and soft gray (#f9fafb)
- **Accent**: Subtle green for success actions
- **Typography**: Inter, system fonts
- **Layout**: Card-based, responsive (mobile-first)
- **Style**: Professional, clean, minimal

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL

### Setup Instructions

1. **Install PHP dependencies**
   ```bash
   composer install
   ```

2. **Install Node dependencies**
   ```bash
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure Database**
   
   Edit `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=14finance
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Create Database**
   ```bash
   mysql -u your_username -p
   CREATE DATABASE 14finance;
   EXIT;
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed Demo Data**
   ```bash
   php artisan db:seed
   ```

8. **Build Assets**
   ```bash
   npm run build
   ```
   
   Or for development:
   ```bash
   npm run dev
   ```

9. **Start the Application**
   ```bash
   php artisan serve
   ```
   
   Visit: `http://localhost:8000`

## Demo Accounts

After seeding, you can login with these credentials:

### Account 1
- **Email**: john@14finance.com
- **Password**: password
- **Has sample transactions**

### Account 2
- **Email**: jane@14finance.com
- **Password**: password

### Account 3
- **Email**: michael@14finance.com
- **Password**: password

## Database Structure

### Users Table
- id, name, email, password, phone, address
- Stores user information

### Accounts Table
- id, user_id, account_number, account_type, balance, status
- One-to-one relationship with users
- Stores account details and balance

### Transactions Table
- id, account_id, transaction_reference, type, category, amount, etc.
- Complete transaction logging
- Tracks balance changes

## Security Features

- Password hashing using bcrypt
- CSRF protection
- Session-based authentication
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)
- Transaction rollback on errors
- Balance validation before transactions

## Usage

### Login
- Use account number or email
- Password: `password` (for demo accounts)

### Transfer Funds
1. Navigate to "Transfer Funds"
2. Enter recipient account number
3. Click "Verify" to confirm recipient
4. Enter amount and optional note
5. Click "Transfer" to complete

### Pay Bills
1. Navigate to "Pay Bills"
2. Select bill type (Electricity, Water, Internet/TV)
3. Enter customer/meter reference number
4. Enter amount
5. Click "Pay" to complete

### View Transactions
- View complete transaction history
- Filter by type or category
- Search by reference, name, or note
- See detailed transaction information

## Project Structure

```
14Finance/
├── app/
│   ├── Livewire/
│   │   ├── Auth/
│   │   │   ├── Login.php
│   │   │   └── Logout.php
│   │   └── Dashboard/
│   │       ├── Index.php
│   │       ├── Transfer.php
│   │       ├── BillPayment.php
│   │       └── TransactionHistory.php
│   └── Models/
│       ├── User.php
│       ├── Account.php
│       └── Transaction.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── components/layouts/
│   │   │   ├── app.blade.php
│   │   │   └── guest.blade.php
│   │   └── livewire/
│   ├── css/
│   └── js/
└── routes/
    └── web.php
```

## Development Team

**Group 14** - University Banking Application Project

## License

This is a university project developed for educational purposes.

## Support

For issues or questions, please contact the development team.

---

© 2026 14Finance | Group 14 Banking Platform
