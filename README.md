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
- Exercise: Technical Formative Assessment 3 - Making It Editable: Forms, Validation, and File Upload

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
- Validated New Customer form
- Validated New User form
- Customer editing workflow
- User editing workflow
- Unique username validation
- Form error messages with preserved input
- Optional JPG and PNG avatar upload
- Maximum avatar upload size of 2 MB
- Prepared 300 × 300 avatar thumbnails
- Placeholder avatar when no image is uploaded
- MySQL-backed customer and user records
- CSRF-protected forms

## Routes

| Method | URL | Description |
|---|---|---|
| GET | `/` | Landing page |
| GET | `/about` | About page |
| GET | `/customers` | Customer listing |
| GET | `/customers/new` | New Customer form |
| POST | `/customers` | Insert a customer |
| GET | `/customers/{id}/edit` | Edit Customer form |
| POST | `/customers/{id}` | Update a customer |
| GET | `/users` | User listing |
| GET | `/users/new` | New User form |
| POST | `/users` | Insert a user |
| GET | `/users/{id}/edit` | Edit User and avatar form |
| POST | `/users/{id}` | Update user and avatar |

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

## Submission Note

This assessment is configured for local execution using XAMPP and
MySQL. Hosting is not required based on the instructor's submission
instructions.