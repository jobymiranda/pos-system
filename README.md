# SimplePOS

SimplePOS is a four-page Point-of-Sale website developed using
CodeIgniter 4. It demonstrates routing, controllers, reusable views,
and temporary PHP array data sources without using a database.

## Student Information

- Name: JOBY MAE M. MIRANDA
- Course and section: BSITBA - TB32
- Subject: IT0049 - Web System Technologies
- Instructor: MR. VON ERICK MAGBITANG
- Exercise: Module 1 - CodeIgniter Foundations

## Features

- Landing page
- About page
- Customer Accounts page
- User Accounts page
- Five temporary customer records
- Five temporary user/staff records
- Shared navigation, header, and footer views
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
- Composer
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

4. Copy the environment template:

   Windows PowerShell:

   ```powershell
   Copy-Item env .env
   ```

5. Configure `.env`:

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'
   ```

6. Start the server:

   ```bash
   php spark serve
   ```

## Live Application

[Open the hosted SimplePOS application](https://simplepos-jobymiranda.onrender.com/)

## Data Source

This version intentionally does not use a database. Customer and user
records are stored in temporary PHP arrays inside their respective
controllers.

## Repository

ADD YOUR GITHUB REPOSITORY URL

## Live Application

ADD YOUR HOSTED APPLICATION URL
