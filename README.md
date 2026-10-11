# CasaForma Furniture Showroom POS

CasaForma is a complete furniture showroom point-of-sale system built with CodeIgniter 4, PHP, MySQL/MariaDB, HTML, CSS, and JavaScript.

It is designed as a polished Bauhaus-inspired furniture management workspace where authorized staff can manage the collection, customer records, team accounts, inventory, and sales transactions.

## Live application

Production URL: **Will be added after Vercel deployment**

Reviewer credentials are shared privately with the professor and are intentionally not published in this repository.

## Key Features

### Authentication and Security

- Secure staff login and logout
- Password hashing with PHP `password_hash()`
- Password verification with `password_verify()`
- Database-backed sessions
- Authentication filter for protected pages
- Guest filter for the login page
- CSRF protection for all submitted forms
- Session ID regeneration after login and logout
- Secure POST-based logout

### Dashboard

- Revenue total for the current day
- Sales count for the current day
- Active furniture collection count
- Low-stock alert count
- Latest sales activity
- Stock-watch panel
- Furniture category gallery
- Featured furniture objects

### Furniture Collection

- Add, edit, archive, and browse furniture products
- Product SKU, name, category, price, stock quantity, and description
- Product categories:
  - Sofa & Seating
  - Tables & Dining
  - Bedroom
  - Lighting
  - Storage
  - Decor & Accents
- Search products by name, SKU, or description
- Filter products by category
- JPG and PNG product image upload
- Uploaded product image preparation and resizing
- Product-card image fallback artwork

### Customer Management

- View all customer records
- Add new customer accounts
- Edit customer information
- Archive customer records
- Required-field validation
- Email address validation
- Clear validation and success messages

### Staff Management

- View staff accounts
- Add and edit staff accounts
- Assign staff roles
- Enforce unique usernames
- Secure password creation and password updates
- Optional JPG and PNG avatar upload
- Prepared avatar images with placeholder fallback

### Sales and Inventory

- Record a sale for a furniture item
- Optional customer selection for walk-in sales
- Automatic sales total calculation
- Inventory reduction after a completed sale
- Overselling prevention
- Sales history
- Printable transaction receipt
- Product, customer, and staff details on every sale

## Design Direction

CasaForma uses a modern Bauhaus and dopamine-decor visual direction:

- Expressive geometric forms
- Cobalt blue, tomato red, vivid yellow, green, and warm neutral colors
- Furniture category imagery
- Responsive product cards and dashboard panels
- Desktop, tablet, and mobile-friendly layouts
- Reduced-motion support for accessibility

## Technology Stack

- PHP 8.2+
- CodeIgniter 4
- MySQL or MariaDB for local development
- TiDB Cloud for Vercel production database hosting
- Vercel Blob for persistent production image uploads
- HTML5
- CSS3
- JavaScript
- Composer
- Git and GitHub
- Vercel

## Local Setup

### 1. Clone the repository

```bash
git clone YOUR-GITHUB-REPOSITORY-URL
cd pos-system
```

### 2. Install PHP dependencies

```bash
composer install
```

### 3. Create the database

Create a MySQL/MariaDB database named:

```text
casaforma_pos
```

### 4. Import the database export

Import this file through phpMyAdmin:

```text
database/casaforma_pos.sql
```

### 5. Configure the environment file

Copy `env` to `.env`, then configure the database section:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = casaforma_pos
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 6. Start the local server

```bash
php spark serve
```

Open:

```text
http://localhost:8080
```

## Production Architecture

CasaForma is prepared for Vercel deployment.

- Vercel serves the CodeIgniter application through the PHP community runtime.
- TiDB Cloud stores production database records and sessions.
- Vercel Blob stores uploaded furniture images and staff avatars.
- The `api/index.php` entry point configures temporary writable folders for the serverless environment.
- `.env` is excluded from GitHub and must never be committed.

## Main Routes

| Route | Purpose |
|---|---|
| `/login` | Secure staff login |
| `/` | Dashboard overview |
| `/products` | Furniture collection |
| `/products/new` | Add furniture |
| `/customers` | Customer management |
| `/customers/new` | Add a customer |
| `/users` | Staff management |
| `/users/new` | Add a staff account |
| `/sales` | Sales history |
| `/sales/new` | Record a sale |
| `/about` | Project information |

## Project Structure

```text
pos-system/
├── api/
│   ├── index.php
│   └── php.ini
├── app/
│   ├── Config/
│   ├── Controllers/
│   ├── Filters/
│   ├── Helpers/
│   ├── Libraries/
│   ├── Models/
│   └── Views/
├── database/
│   └── casaforma_pos.sql
├── public/
│   ├── css/
│   ├── images/
│   ├── js/
│   └── uploads/
├── writable/
├── vercel.json
├── .vercelignore
├── composer.json
└── spark
```

## Testing Checklist

Before deployment, test the following locally:

- Login with an authorized account
- Create, edit, and archive a furniture product
- Upload and display a product image
- Filter furniture by category
- Search the furniture collection
- Create, edit, and archive a customer
- Create and edit a staff account
- Upload and display a staff avatar
- Record a valid sale
- Confirm product stock decreases after a sale
- Attempt an oversell and confirm it is rejected
- View the sales history and printable receipt
- Test the layout on desktop and mobile screen widths

## Academic Project

Developed for **IT0049 – Web System Technologies**.

CasaForma combines the required CodeIgniter CRUD, validation, authentication, file upload, sales, inventory, database, and deployment concepts into one complete point-of-sale system.