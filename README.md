# SimplePOS

SimplePOS is a secure customer and staff account management system
developed using CodeIgniter 4, PHP, and MySQL for IT0049 Web System
Technologies.

The project demonstrates the Model-View-Controller architecture,
database-backed record management, validated forms, file uploads,
sessions, authentication, and protected application routes.

## Project Status

This repository contains the completed continuation of the following
laboratory activities:

- CodeIgniter routing, controllers, and views
- Database-backed customer and user accounts
- Create and edit forms
- Server-side validation
- User avatar upload and image preparation
- Sessions and authentication
- Protected routes and secure logout

## Main Features

### Authentication and Security

- Database-backed staff login
- Secure password hashing using `password_hash()`
- Password verification using `password_verify()`
- Server-side session authentication
- Session ID regeneration after login and logout
- Authentication filters for protected pages
- Guest filter for the login page
- CSRF protection on submitted forms
- Generic login errors that do not reveal which credential was wrong
- Secure POST-based logout

### Customer Account Management

- Display customer records from MySQL
- Add new customer accounts
- Edit existing customer accounts
- Validate required customer information
- Validate email addresses
- Preserve submitted form values when validation fails
- Display clear validation and success messages

### User Account Management

- Display staff accounts from MySQL
- Create new staff accounts
- Enforce unique usernames
- Assign account roles
- Edit existing staff information
- Create securely hashed passwords
- Change passwords without displaying the existing password hash
- Preserve the current password when the password field is left blank
- Update the active session when the logged-in user edits their account

### Avatar Upload

- Optional user profile-picture upload
- JPG and PNG validation
- Maximum file size of 2 MB
- Image validation using CodeIgniter
- Display-ready 400 × 400 avatar preparation
- Randomized filenames
- Only the generated filename is stored in MySQL
- Replacement of an existing avatar
- Placeholder avatar when no profile picture is available

### User Interface

- Responsive professional dashboard
- Secure-session status display
- Consistent navigation
- Logged-in user identity and role
- Professional customer and user tables
- Responsive account forms
- Clear alerts and validation feedback
- Mobile-friendly layouts

## Technologies Used

- PHP 8.2+
- CodeIgniter 4
- MySQL or MariaDB
- HTML5
- CSS3
- JavaScript
- Composer
- XAMPP
- Git and GitHub

## Project Structure

```text
pos-system/
├── app/
│   ├── Config/
│   │   ├── Filters.php
│   │   └── Routes.php
│   ├── Controllers/
│   │   ├── Auth.php
│   │   ├── Customers.php
│   │   ├── Pages.php
│   │   └── Users.php
│   ├── Filters/
│   │   ├── AuthFilter.php
│   │   └── GuestFilter.php
│   ├── Models/
│   │   ├── CustomerModel.php
│   │   └── UserModel.php
│   └── Views/
│       ├── auth/
│       ├── customers/
│       ├── pages/
│       ├── templates/
│       └── users/
├── database/
│   └── pos_system.sql
├── public/
│   ├── css/
│   │   └── style.css
│   ├── images/
│   │   └── avatar-placeholder.svg
│   └── uploads/
│       └── avatars/
├── writable/
├── .gitignore
├── composer.json
├── env
└── spark