# Absence QR App

A Laravel-based application for managing events and attendance tracking using QR codes. This application allows organizers to create events and track attendees through QR code scanning.

## Application Overview

The Absence QR App is a web-based solution designed to simplify event management and attendance tracking. Using modern web technologies and QR code functionality, it provides a streamlined process for:

- Creating and managing events
- Generating unique QR codes for each event
- Registering attendees
- Tracking attendance in real-time
- Managing event data and attendance records

### Key Features

- **Event Management**: Create, edit, and delete events with details such as name, description, location, start date, and end date
- **QR Code Generation**: Automatically generate unique QR codes for each event
- **Attendee Registration**: Register attendees with their name, school, and contact information
- **Attendance Tracking**: Scan QR codes to mark attendance with timestamps
- **Data Export**: Export attendee data for reporting purposes
- **User Authentication**: Secure login and user management

## Tech Stack

- **Framework**: Laravel 12.x
- **Frontend**: Livewire and Volt
- **UI**: TailwindCSS 4.x
- **Database**: MySQL/SQLite
- **QR Code**: SimpleSoftwareIO QR Code Generator
- **Data Processing**: PHPSpreadsheet
- **Testing**: Pest

## Installation Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or SQLite

## Installation

Follow these steps to set up the application on your local machine:

### 1. Clone the repository

```bash
git clone https://your-repository-url/absence-qr-app.git
cd absence-qr-app
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Install JavaScript dependencies

```bash
npm install
```

### 4. Create environment file

```bash
cp .env.example .env
```

### 5. Generate application key

```bash
php artisan key:generate
```

### 6. Configure your database

Edit the `.env` file and set your database connection details:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=absence_qr_app
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

For SQLite (alternative):

```env
DB_CONNECTION=sqlite
# Create an empty database file
touch database/database.sqlite
```

### 7. Run database migrations

```bash
php artisan migrate
```

### 8. Seed the database (optional)

```bash
php artisan db:seed
```

### 9. Build assets

```bash
npm run build
```

### 10. Start the development server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## Development

For development purposes, you can run:

```bash
# Run Vite development server
npm run dev

# In another terminal, run Laravel's development server
php artisan serve
```

## Testing

Run tests using Pest:

```bash
./vendor/bin/pest
```

## License

This project is licensed under the MIT License.

## Credits

- Built with [Laravel](https://laravel.com/)
- QR code generation by [SimpleSoftwareIO](https://github.com/SimpleSoftwareIO/simple-qrcode)
- Data processing with [PHPSpreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)
