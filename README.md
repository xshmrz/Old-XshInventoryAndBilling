# Inventory and Billing Management System

This project is an inventory and billing management system built using Laravel. It includes features for managing
products, accounts, invoices, payments, and various settings including online payments and SMS notifications.

<img src="README.webp" style="border-radius: 10px !important">

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Database Structure](#database-structure)
- [Seeder Data](#seeder-data)
- [Enums](#enums)
- [License](#license)

## Features

- Product management with categories and brands
- Account management for customers and suppliers
- Invoice creation and management
- Payment tracking and online payment integration
- Income and expense tracking
- Role-based user management
- System settings including SMS and online payment settings

## Installation

### Prerequisites

- PHP >= 7.4
- Composer
- MySQL or other supported database

### Steps

1. Clone the repository

   ```bash
   git clone https://github.com/yourusername/yourrepository.git
   cd yourrepository
   ```

2. Install dependencies

   ```bash
   composer install
   ```

3. Copy the `.env.example` file to `.env`

   ```bash
   cp .env.example .env
   ```

4. Generate the application key

   ```bash
   php artisan key:generate
   ```

5. Configure your database settings in the `.env` file

6. Run the migrations and seed the database

   ```bash
   php artisan migrate --seed
   ```

7. Start the development server

   ```bash
   php artisan serve
   ```

## Usage

After installation, you can access the application at `http://localhost:8000`.

### Admin User

You can log in using the following default admin user credentials:

- **Email:** admin@example.com
- **Password:** password

## Database Structure

The database structure includes the following tables:

- `product_category`
- `product_brand`
- `product`
- `product_feature`
- `stock_warehouse`
- `stock_movement`
- `stock_count`
- `account`
- `account_type`
- `account_movement`
- `account_balance`
- `account_group`
- `account_contact`
- `invoice`
- `invoice_detail`
- `invoice_type`
- `invoice_payment_method`
- `payment`
- `invoice_status`
- `invoice_series`
- `income`
- `expense`
- `income_expense_type`
- `income_expense_category`
- `cash_movement`
- `cash_type`
- `bank_account`
- `bank_movement`
- `user`
- `role`
- `permission`
- `user_role`
- `user_activity_log`
- `payment_method`
- `online_payment_transaction`
- `payment_status`
- `credit_card_info`
- `payment_provider`
- `refund_transaction`
- `settings`

## Seeder Data

The seeder files are located in the `database/seeds` directory. You can use them to populate the database with initial
data.

To run the seeders:

```bash
php artisan db:seed
```

## Enums

The project includes several enums for managing constants:

- `EnumYesNo`
- `EnumMovementType`
- `EnumAccountType`
- `EnumInvoiceStatus`
- `EnumPaymentMethod`
- `EnumIncomeExpenseType`
- `EnumContactType`

Each enum class provides a method for getting translations for its values.

Example:

```php
<?php

class EnumYesNo extends EnumBase {
    const Yes = 1;
    const No  = 2;

    public static function getTranslation($key) {
        return [
            self::Yes => trans("app.Yes"),
            self::No  => trans("app.No"),
        ][$key];
    }
}
```

## License

This project is open-source and licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.
