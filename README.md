# 🍕 Pizza House

A small Laravel 10 app for a made-up Barbadian pizza shop. Customers build a pizza (type, crust, toppings), get an instant price, and place an order. Staff review, complete or cancel orders on a protected page.

## Features

- Order form with server-side validation and price calculation (BBD)
- Staff-only order list, detail, **complete** and **cancel** actions, protected with HTTP Basic auth
- Eloquent model with array-cast toppings, a factory and seeder for demo data
- Feature tests covering ordering, validation, auth and staff actions

## Stack

PHP 8.1+, Laravel 10, MySQL (or SQLite), Blade, plain CSS.

## Setup

```bash
git clone https://github.com/KrishnaClarke/pizzahouse.git
cd pizzahouse
composer install
cp .env.example .env
php artisan key:generate
# create the database, set DB_* and ADMIN_* in .env, then:
php artisan migrate --seed
php artisan serve
```

- Customers: http://localhost:8000
- Staff: http://localhost:8000/pizzas (log in with `ADMIN_USER` / `ADMIN_PASSWORD`)

## Tests

```bash
php artisan test
```

Tests use an in-memory SQLite database.

## Pricing

Base price by pizza type, plus a crust surcharge (cheese +$8, garlic +$5) and $3 per extra topping. See `app/Models/Pizza.php`.

## Ideas for next steps

- Real user accounts (Laravel Breeze) instead of HTTP Basic
- Delivery address and phone number
- Order status emails
- Charts of orders and revenue for the staff page
