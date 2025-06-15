# Sneaker API Backend

This repository contains the Laravel 12.x based API backend for the Sneaker e‑commerce project. It supports user authentication (with roles), product catalog, shopping cart, order checkout, and admin management.

---

## Table of Contents

1. [Features](#features)
2. [Requirements](#requirements)
3. [Installation](#installation)
4. [Configuration](#configuration)
5. [Database Migrations & Seeders](#database-migrations--seeders)
6. [API Endpoints](#api-endpoints)
7. [Testing](#testing)
8. [Design Patterns](#design-patterns)
9. [License](#license)

---

## Features

* **User Authentication**: Registration, login, logout, password change (Sanctum tokens)
* **Roles**: `admin` and `user` roles enforced via middleware
* **Product Catalog**: CRUD for sneakers, categories; public listing with filters (search, category, color, size, price range)
* **Shopping Cart**: Add/remove/update items with chosen size; cart persistence by user or session token
* **Checkout & Orders**: Address & payment email, order creation, status tracking, email invoice, cart clearance
* **Admin Panel (API)**: Protected endpoints under `/api/admin` for products & categories management

---

## Requirements

* PHP 8.2+
* Laravel 12.x
* MySQL ≥ 5.7 or PostgreSQL
* Composer

---

## Installation

```bash
# Clone repository
git clone <repo-url>
cd <project>

# Install dependencies
composer install

# Copy .env and generate key
cp .env.example .env
php artisan key:generate

# Run migrations & seeders
php artisan migrate --seed

# Start local server
php artisan serve
```

---

## Configuration

In `.env` set your database credentials and other settings:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sneaker_db
DB_USERNAME=root
DB_PASSWORD=secret

SANCTUM_STATEFUL_DOMAINS=localhost
```

---

## Database Migrations & Seeders

* Migrations are in `database/migrations/`
* Seeders for categories, products, users in `database/seeders/`
* Custom migration `add_size_to_sneaker_cart_items` adds JSON `size` column

Run all:

```bash
php artisan migrate --seed
```

---



## Testing

* **Unit tests**: `tests/Unit/` (Action, Service, Filter tests)
* **Feature tests**: `tests/Feature/CheckoutTest.php`, plus others for auth, cart, admin
* Run all tests:

  ```bash
  php artisan test
  ```

---
## Api
* Check postman file url http://back-bortpress.ru/api

## License

This project is open-source and available under the MIT License.
