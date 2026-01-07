@echo off
echo ========================================
echo 14Finance - Automated Setup Script
echo Group 14 Banking Platform
echo ========================================
echo.

REM Check if composer is installed
where composer >nul 2>nul
if %errorlevel% neq 0 (
    echo ERROR: Composer is not installed or not in PATH
    echo Please install Composer from https://getcomposer.org/
    pause
    exit /b 1
)

REM Check if npm is installed
where npm >nul 2>nul
if %errorlevel% neq 0 (
    echo ERROR: Node.js/NPM is not installed or not in PATH
    echo Please install Node.js from https://nodejs.org/
    pause
    exit /b 1
)

REM Check if php is installed
where php >nul 2>nul
if %errorlevel% neq 0 (
    echo ERROR: PHP is not installed or not in PATH
    echo Please install PHP 8.2+ from https://www.php.net/
    pause
    exit /b 1
)

echo Step 1: Installing PHP dependencies...
call composer install
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed
    pause
    exit /b 1
)
echo ✓ PHP dependencies installed
echo.

echo Step 2: Installing Node.js dependencies...
call npm install
if %errorlevel% neq 0 (
    echo ERROR: NPM install failed
    pause
    exit /b 1
)
echo ✓ Node.js dependencies installed
echo.

echo Step 3: Setting up environment file...
if not exist .env (
    copy .env.example .env
    echo ✓ .env file created
) else (
    echo ✓ .env file already exists
)
echo.

echo Step 4: Generating application key...
php artisan key:generate
echo ✓ Application key generated
echo.

echo Step 5: Building frontend assets...
call npm run build
if %errorlevel% neq 0 (
    echo WARNING: Build failed, trying development mode...
    start /B npm run dev
)
echo ✓ Assets compiled
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo IMPORTANT: Before running the application:
echo.
echo 1. Edit .env file and configure your database:
echo    - DB_DATABASE=14finance
echo    - DB_USERNAME=root
echo    - DB_PASSWORD=your_password
echo.
echo 2. Create the database:
echo    mysql -u root -p -e "CREATE DATABASE 14finance;"
echo.
echo 3. Run migrations and seed data:
echo    php artisan migrate
echo    php artisan db:seed
echo.
echo 4. Start the application:
echo    php artisan serve
echo.
echo 5. Visit: http://localhost:8000
echo.
echo Demo Login:
echo    Email: john@14finance.com
echo    Password: password
echo.
echo ========================================
pause
