# Laravel Item Management System

A complete item management system built with Laravel (backend) and modern Vue/Vite (frontend) in a monolithic architecture.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Project Structure](#project-structure)
- [API Endpoints](#api-endpoints)
- [Technology Stack](#technology-stack)
- [License](#license)

## Features

### Backend

- 🏗️ Laravel 12+
- 🔐 Authentication
- 🗄️ Eloquent ORM with PostgreSQL
- ✅ Request validation
- 📦 CRUD Items

### Frontend

- ⚛️ Vue 3+ with TypeScript
- ⚡ Vite build tool
- 🎨 TailwindCSS with reka/ui components
- 📝 Form handling Zod
- 💅 Modern UI with dark/light mode

## Prerequisites

- PHP 8.2+
- Composer 2.5+
- Node.js 18+
- npm 9+ or yarn 1.22+
- MySQL 8.0+ or PostgreSQL 5+

## Installation

1. Clone the repository:

    ```bash
    git clone https://github.com/anrisys/test-case_monolith-laravel.git
    cd test-case_monolith-laravel
    ```

2. Install PHP dependencies:

    ```bash
    composer install
    ```

3. Install JavaScript dependencies

    ```bash
    npm install
    ```

4. Create and configure environment file:

    ```bash
    cp .env.example .env
    ```

## Configuration

1. Database setup in .env:

    ```bash
    DB_CONNECTION=pgsql
    DB_HOST=localhost
    DB_PORT=5432
    DB_DATABASE=your_database
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

    - Make sure the database already created
    - You can use the database you want. Make sure to use the correct driver.

## Running the application

1.  Start the Laravel development server:

    ```bash
    php artisan serve
    ```

2.  Start the Vite development server (in another terminal):

    ```bash
    npm run dev
    ```

3.  Access the application at:

    ```bash
    http://localhost:8000
    ```

## Author

The author of this app is Anris Y. Simorangkir.

[LinkedIn](https://www.linkedin.com/in/anris-y-simorangkir/)

[Gmail](mailto:anris.y.simorangkir@gmail.com)
