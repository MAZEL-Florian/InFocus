<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></p>

# InFocus

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 🚀 About InFocus

Infocus is a powerful web application built with Laravel, offering elegant solutions with a modern tech stack. Our project leverages the expressive, elegant syntax of Laravel while enhancing the development experience with:

- [Tailwind CSS](https://tailwindcss.com/) for utility-first CSS framework
- [Vite](https://vitejs.dev/) for next-generation frontend tooling
- [FilamentPHP](https://filamentphp.com/) for rapid admin panel development

## 🛠️ Technology Stack

- **[Laravel](https://laravel.com/)** - The core PHP framework providing:
  - [Simple, fast routing engine](https://laravel.com/docs/routing)
  - [Powerful dependency injection container](https://laravel.com/docs/container)
  - [Expressive, intuitive database ORM](https://laravel.com/docs/eloquent)
  - [Database migrations](https://laravel.com/docs/migrations)
  - [Background job processing](https://laravel.com/docs/queues)
  - [Real-time event broadcasting](https://laravel.com/docs/broadcasting)

- **[Tailwind CSS](https://tailwindcss.com/)** - A utility-first CSS framework for rapid UI development

- **[Vite](https://vitejs.dev/)** - Next-generation frontend build tool replacing Laravel Mix

- **[FilamentPHP](https://filamentphp.com/)** - A collection of tools for rapidly building Laravel TALL stack applications

## 📋 Requirements

- PHP 8.1 or higher
- Composer
- Node.js (18.x or higher)
- NPM or Yarn

## ⚡ Quick Start

### Installation

```bash
# Clone the repository
git clone https://github.com/MAZEL-Florian/InFocus.git

# Navigate to the project directory
cd InFocus

# Install PHP dependencies
composer install

# Install NPM dependencies
npm install
# or if using Yarn
yarn install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Configure your database in .env file
# Then run migrations
php artisan migrate

# Build assets
npm run dev
# or with Yarn
yarn dev
```

### Running the Application

```bash
# Start the development server
php artisan serve

# In a separate terminal, compile assets
npm run dev
# or with Yarn
yarn dev

# For production build
npm run build
# or with Yarn
yarn build
```

## 📚 Documentation

For detailed documentation on the components used in this project, refer to:

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/guide/)
- [FilamentPHP Documentation](https://filamentphp.com/docs)

## 🧪 Testing

```bash
# Run PHPUnit tests
php artisan test

```
