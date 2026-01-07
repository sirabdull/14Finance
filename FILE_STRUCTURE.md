# 14Finance - Complete Project Structure

## Overview
This document provides a complete overview of all files and directories in the 14Finance project.

---

## Root Directory Files

### Configuration Files
- `.env.example` - Environment configuration template
- `.gitignore` - Git ignore rules
- `composer.json` - PHP dependencies
- `package.json` - Node.js dependencies
- `tailwind.config.js` - Tailwind CSS configuration
- `vite.config.js` - Vite build configuration
- `phpunit.xml` - PHPUnit testing configuration
- `artisan` - Laravel command-line tool

### Documentation Files
- `README.md` - Main project documentation
- `SETUP.md` - Detailed setup instructions
- `PROJECT_SUMMARY.md` - Complete project summary
- `PRESENTATION.md` - Presentation guide for evaluators
- `CHECKLIST.md` - Pre-demonstration checklist
- `FILE_STRUCTURE.md` - This file

### Setup Scripts
- `setup.bat` - Windows automated setup
- `setup.sh` - Linux/Mac automated setup

---

## Directory Structure

```
14Finance/
│
├── app/                                    # Application code
│   ├── Http/
│   │   └── Controllers/                   # (Laravel default, not used with Livewire)
│   │
│   ├── Livewire/                          # Livewire components
│   │   ├── Auth/
│   │   │   ├── Login.php                  # Login component
│   │   │   └── Logout.php                 # Logout component
│   │   │
│   │   └── Dashboard/
│   │       ├── Index.php                  # Main dashboard
│   │       ├── Transfer.php               # Fund transfer
│   │       ├── BillPayment.php            # Bill payment
│   │       └── TransactionHistory.php     # Transaction history
│   │
│   ├── Models/                            # Eloquent models
│   │   ├── User.php                       # User model
│   │   ├── Account.php                    # Account model
│   │   └── Transaction.php                # Transaction model
│   │
│   └── Providers/
│       └── AppServiceProvider.php         # Service provider
│
├── bootstrap/                             # Application bootstrap
│   ├── app.php
│   ├── providers.php
│   └── cache/                             # Bootstrap cache
│
├── config/                                # Configuration files
│   ├── app.php                            # Application config
│   ├── auth.php                           # Authentication config
│   ├── database.php                       # Database config
│   ├── session.php                        # Session config
│   └── ... (other config files)
│
├── database/                              # Database files
│   ├── factories/
│   │   └── UserFactory.php                # User factory
│   │
│   ├── migrations/                        # Database migrations
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 0001_01_01_000001_create_cache_table.php
│   │   ├── 0001_01_01_000002_create_jobs_table.php
│   │   ├── 2024_01_07_000003_create_accounts_table.php
│   │   ├── 2024_01_07_000004_create_transactions_table.php
│   │   └── 2024_01_07_000005_add_account_fields_to_users_table.php
│   │
│   └── seeders/
│       └── DatabaseSeeder.php             # Database seeder with demo data
│
├── public/                                # Public web root
│   ├── index.php                          # Entry point
│   └── robots.txt                         # Robots file
│
├── resources/                             # Frontend resources
│   ├── css/
│   │   └── app.css                        # Main CSS file with Tailwind
│   │
│   ├── js/
│   │   ├── app.js                         # Main JavaScript file
│   │   └── bootstrap.js                   # Bootstrap file
│   │
│   └── views/                             # Blade views
│       ├── components/
│       │   └── layouts/
│       │       ├── app.blade.php          # Authenticated layout
│       │       └── guest.blade.php        # Guest layout
│       │
│       └── livewire/                      # Livewire component views
│           ├── auth/
│           │   └── login.blade.php        # Login view
│           │
│           └── dashboard/
│               ├── index.blade.php        # Dashboard view
│               ├── transfer.blade.php     # Transfer view
│               ├── bill-payment.blade.php # Bill payment view
│               └── transaction-history.blade.php  # History view
│
├── routes/                                # Route definitions
│   ├── web.php                            # Web routes
│   └── console.php                        # Console routes
│
├── storage/                               # Storage directory
│   ├── app/                               # Application storage
│   │   ├── private/
│   │   └── public/
│   │
│   ├── framework/                         # Framework storage
│   │   ├── cache/
│   │   ├── sessions/
│   │   ├── testing/
│   │   └── views/
│   │
│   └── logs/                              # Application logs
│       └── laravel.log
│
├── tests/                                 # Test files
│   ├── Feature/
│   │   └── ExampleTest.php
│   │
│   └── Unit/
│       └── ExampleTest.php
│
└── vendor/                                # Composer dependencies
    └── ... (all PHP packages)
```

---

## Key Files Explained

### Application Logic

#### Models
**app/Models/User.php**
- User authentication model
- Relationship with Account
- Password hashing
- Personal information

**app/Models/Account.php**
- Bank account model
- Relationship with User and Transactions
- Account number generation
- Balance management

**app/Models/Transaction.php**
- Transaction records
- Transaction reference generation
- Relationship with Account
- Balance tracking

#### Livewire Components

**app/Livewire/Auth/Login.php**
- Handles user authentication
- Supports email or account number login
- Session management
- Validation rules

**app/Livewire/Dashboard/Index.php**
- Main dashboard component
- Displays account summary
- Shows recent transactions
- Balance visibility toggle

**app/Livewire/Dashboard/Transfer.php**
- Fund transfer functionality
- Recipient verification
- Balance validation
- Database transaction handling

**app/Livewire/Dashboard/BillPayment.php**
- Bill payment processing
- Multiple bill types
- Service provider selection
- Payment validation

**app/Livewire/Dashboard/TransactionHistory.php**
- Complete transaction log
- Filtering and search
- Pagination
- Transaction details

### Views

**resources/views/components/layouts/app.blade.php**
- Authenticated user layout
- Navigation bar
- Success message display
- Footer

**resources/views/components/layouts/guest.blade.php**
- Guest layout (login page)
- Minimal design
- 14Finance branding

**resources/views/livewire/**
- Component-specific views
- Professional card-based design
- Responsive layouts
- Form validations

### Database

**database/migrations/**
- Schema definitions
- Table structures
- Foreign key relationships
- Indexes

**database/seeders/DatabaseSeeder.php**
- Creates 3 demo users
- Generates accounts with random balances
- Seeds sample transactions
- Displays credentials after seeding

### Configuration

**tailwind.config.js**
- Custom color palette
- Primary blue shades
- Accent green colors
- Font family configuration

**resources/css/app.css**
- Tailwind directives
- Custom component classes
- Button styles
- Card styles
- Input field styles

**routes/web.php**
- Application routes
- Middleware configuration
- Route names
- Authentication guards

### Environment

**.env.example**
- Template configuration
- Database settings
- Application settings
- Session configuration

---

## File Categories

### Created/Modified for 14Finance
✅ New Files:
- All files in `app/Livewire/`
- `app/Models/Account.php`
- `app/Models/Transaction.php`
- All views in `resources/views/livewire/`
- Layout views in `resources/views/components/layouts/`
- Custom migrations in `database/migrations/`
- `database/seeders/DatabaseSeeder.php`
- `tailwind.config.js`
- Documentation files (README, SETUP, etc.)
- Setup scripts (setup.bat, setup.sh)

✅ Modified Files:
- `app/Models/User.php` (added relationships)
- `resources/css/app.css` (added custom styles)
- `resources/js/app.js` (added Livewire)
- `routes/web.php` (added routes)
- `.env.example` (updated defaults)

### Laravel Default Files
📦 Unchanged:
- Most files in `config/`
- `bootstrap/` files
- `public/index.php`
- `artisan`
- `composer.json` base structure
- `package.json` base structure

---

## Important Paths

### For Evaluation
```
Models:          app/Models/
Components:      app/Livewire/
Views:           resources/views/livewire/
Styles:          resources/css/app.css
Routes:          routes/web.php
Migrations:      database/migrations/
Seeder:          database/seeders/DatabaseSeeder.php
```

### For Development
```
Logs:            storage/logs/laravel.log
Cache:           storage/framework/cache/
Sessions:        storage/framework/sessions/
Config:          config/
Environment:     .env
```

### For Documentation
```
Main Doc:        README.md
Setup Guide:     SETUP.md
Summary:         PROJECT_SUMMARY.md
Presentation:    PRESENTATION.md
Checklist:       CHECKLIST.md
This File:       FILE_STRUCTURE.md
```

---

## File Count Summary

- **Total Project Files**: 1000+ (including vendor)
- **Custom PHP Files**: 13
- **Blade Views**: 7
- **Migrations**: 6
- **Models**: 3
- **Livewire Components**: 6
- **Documentation Files**: 6
- **Setup Scripts**: 2

---

## Next Steps After Setup

1. Review all files in `app/Livewire/`
2. Check database schema in `database/migrations/`
3. Understand routes in `routes/web.php`
4. Review views in `resources/views/livewire/`
5. Read documentation files

---

**Group 14 - 14Finance**
© 2026 Banking Platform
