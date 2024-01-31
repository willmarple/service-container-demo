# Getting Started with the Service Container Demo

Welcome to the Service Container Demo! This project is designed to showcase the power and flexibility of Laravel's service container, including how to work with different payment processors like Stripe and PayPal. Follow the steps below to get started with this demo.

## Prerequisites

Before you begin, ensure you have the following installed on your system:
- PHP >= 8.1
- Composer
- A Laravel-supported database (MySQL, PostgreSQL, SQLite, SQL Server)
- Node.js and NPM (for compiling assets)
- **Important** You will need to head over to Stripe and generate test api keys

## Recommendations for macOS Users

For macOS users looking to enhance their development experience with the Service Container Demo, we highly recommend the following tools:

1. **Herd**: Herd is a blazing fast, native Laravel and PHP development environment for macOS. It includes everything you need to get started with Laravel development, including PHP and nginx. Once you install Herd, you're ready to start developing with Laravel.

2. **DBngin**: A powerful and free tool for macOS that simplifies database management. It supports multiple versions of MySQL, PostgreSQL, and Redis, allowing you to easily create and manage databases with just a few clicks. DBngin's seamless integration and ease of use make it an ideal choice for Laravel developers looking to streamline their database setup and management process.

## Installation

1. **Clone the Repository**

   Start by cloning this repository to your local machine:
   ```bash
   git clone https://github.com/willmarple/service-container-demo.git
   ```

2. **Install Dependencies**

   Navigate into the project directory and install PHP and JavaScript dependencies:
   ```bash
   cd service-container-demo
   composer install
   npm install && npm run dev
   ```

3. **Environment Configuration**

   Copy the `.env.example` file to a new file named `.env`:
   ```bash
   cp .env.example .env
   ```
   Then, open the `.env` file and update the database and other environment-specific settings.

4. **Generate Application Key**

   Generate a new application key:
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Migrate your database to create the necessary tables:
   ```bash
   php artisan migrate
   ```

6. **Start the Server**

   If you're using Herd, skip this step.  Otherwise, start the Laravel development server:
   ```bash
   php artisan serve
   ```
   Your service container demo is now up and running! Access it at http://localhost:8000.

## Further Reading

- [Laravel Service Container](https://laravel.com/docs/container)
- [Stripe PHP SDK](https://github.com/stripe/stripe-php)
- [PayPal PHP SDK](https://developer.paypal.com/docs/api/overview/)

