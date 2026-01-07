#!/bin/bash

echo "========================================"
echo "14Finance - Automated Setup Script"
echo "Group 14 Banking Platform"
echo "========================================"
echo ""

# Check if composer is installed
if ! command -v composer &> /dev/null; then
    echo "ERROR: Composer is not installed"
    echo "Please install Composer from https://getcomposer.org/"
    exit 1
fi

# Check if npm is installed
if ! command -v npm &> /dev/null; then
    echo "ERROR: Node.js/NPM is not installed"
    echo "Please install Node.js from https://nodejs.org/"
    exit 1
fi

# Check if php is installed
if ! command -v php &> /dev/null; then
    echo "ERROR: PHP is not installed"
    echo "Please install PHP 8.2+ from https://www.php.net/"
    exit 1
fi

echo "Step 1: Installing PHP dependencies..."
composer install
if [ $? -ne 0 ]; then
    echo "ERROR: Composer install failed"
    exit 1
fi
echo "✓ PHP dependencies installed"
echo ""

echo "Step 2: Installing Node.js dependencies..."
npm install
if [ $? -ne 0 ]; then
    echo "ERROR: NPM install failed"
    exit 1
fi
echo "✓ Node.js dependencies installed"
echo ""

echo "Step 3: Setting up environment file..."
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✓ .env file created"
else
    echo "✓ .env file already exists"
fi
echo ""

echo "Step 4: Generating application key..."
php artisan key:generate
echo "✓ Application key generated"
echo ""

echo "Step 5: Building frontend assets..."
npm run build
if [ $? -ne 0 ]; then
    echo "WARNING: Build failed"
fi
echo "✓ Assets compiled"
echo ""

echo "========================================"
echo "Setup Complete!"
echo "========================================"
echo ""
echo "IMPORTANT: Before running the application:"
echo ""
echo "1. Edit .env file and configure your database:"
echo "   - DB_DATABASE=14finance"
echo "   - DB_USERNAME=root"
echo "   - DB_PASSWORD=your_password"
echo ""
echo "2. Create the database:"
echo "   mysql -u root -p -e 'CREATE DATABASE 14finance;'"
echo ""
echo "3. Run migrations and seed data:"
echo "   php artisan migrate"
echo "   php artisan db:seed"
echo ""
echo "4. Start the application:"
echo "   php artisan serve"
echo ""
echo "5. Visit: http://localhost:8000"
echo ""
echo "Demo Login:"
echo "   Email: john@14finance.com"
echo "   Password: password"
echo ""
echo "========================================"
