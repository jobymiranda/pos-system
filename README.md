# SimplePOS

SimplePOS is a four-page Point-of-Sale website developed using
CodeIgniter 4 and MySQL. It demonstrates routing, controllers,
reusable views, Models, Query Builder, and database-backed customer
and user account listings.

## Student Information

- Name: JOBY MAE M. MIRANDA
- Course and section: BSITBA - TB32
- Subject: IT0049 - Web System Technologies
- Instructor: MR. VON ERICK MAGBITANG
- Exercise: Technical Formative Assessment 2 - From Arrays to a Real Database

## Features

- Landing page
- About page
- Customer Accounts page backed by MySQL
- User Accounts page backed by MySQL
- CodeIgniter CustomerModel and UserModel
- Query Builder record retrieval through `findAll()`
- Five customer sample records
- Five user/staff sample records
- Reusable navigation, header, and footer views
- Responsive account tables

## Routes

| Method | URL | Controller |
|---|---|---|
| GET | `/` | `Pages::index` |
| GET | `/about` | `Pages::about` |
| GET | `/customers` | `Customers::index` |
| GET | `/users` | `Users::index` |

## Technologies

- PHP 8.2 or newer
- CodeIgniter 4
- MySQL
- Composer
- Docker
- HTML5
- CSS3

## Local Setup

1. Clone the repository:

   ```bash
   git clone YOUR-REPOSITORY-URL
   ```

2. Enter the project:

   ```bash
   cd pos-system
   ```

3. Install dependencies:

   ```bash
   composer install
   ```

4. Start Apache and MySQL using XAMPP.

5. Open phpMyAdmin and create a database named `pos_system`.

6. Import the database export:

   ```text
   database/pos_system.sql
   ```

7. Copy the environment template:

   ```powershell
   Copy-Item env .env
   ```

8. Open `.env` and configure it:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'

   database.default.hostname = localhost
   database.default.database = pos_system
   database.default.username = root
   database.default.password =
   database.default.DBDriver = MySQLi
   database.default.DBPrefix =
   database.default.port = 3306
   ```

9. Start the application:

   ```powershell
   php spark serve
   ```

10. Open the application in your browser:

   ```text
   http://localhost:8080
   ```

## Database

This version uses a MySQL database named `pos_system`.

The database contains the following tables:

- `customers`
- `users`

A complete database export is included at:

```text
database/pos_system.sql
```

## Repository

https://github.com/jobymiranda/pos-system

## Live Application

[Open the existing hosted SimplePOS application](https://simplepos-jobymiranda.onrender.com/)

The TFA2 MySQL-backed version is configured for local execution. The existing hosted link displays the earlier version because Railway deployment was skipped.