# My Application

This is a web application built using PHP, MySQL, Bootstrap, jQuery and Ajax. It includes modules for users and administrators, a book management system, and various functionalities such as registration, login, profile editing, and book collection management.

## Table of Contents

- [Features](#features)
- [Technologies](#technologies)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [Database Schema](#database-schema)
- [Notes](#notes)

## Features

- **User Registration**: Users can register by providing their first name, last name, email, and password. The registration includes password confirmation and strength indicator.
- **User Login**: Users can log in using their email and password, with an approval requirement by administrators.
- **Logout**: Users can log out of their accounts.
- **Profile Editing**: Users can edit their profile information, including first name, last name and password. Password changes require confirmation and display strength indicators.
- **Book Management**: Administrators can create and edit book records, including name, ISBN, and description.
- **Home Page**: Displays a list of books with options to add or remove books from the user's collection.
- **Admin Dashboard**: Administrators can view and activate new user registrations.
- **AJAX**: The registration and login forms use AJAX to handle submissions and display error messages without page reloads.
- **User-Friendly URLs**: URLs are clean and user-friendly using `.htaccess` rules.

## Technologies

- **Server-Side**: PHP (Vanilla OOP PHP)
- **Database**: MySQL
- **Frontend**: Bootstrap, jQuery, FontAwesome
- **Additional Tools**: Apache (with mod_rewrite)

## Installation

1. **Clone the repository**:
    ```sh
    git clone https://github.com/Nedelcev/xs-task.git
    cd xs-task
    ```

2. **Set up the database**:
    - Import the provided SQL schema (see [Database Schema](#database-schema)) into your MySQL database.
    - Update `db.php` with your database credentials.

3. **Configure Apache**:
    - Ensure `mod_rewrite` is enabled:
      ```sh
      sudo a2enmod rewrite
      sudo service apache2 restart
      ```
    - Update your site's configuration to allow `.htaccess` files:
      ```apache
      <Directory /path/to/your/project>
          AllowOverride All
      </Directory>
      ```
    - Restart Apache:
      ```sh
      sudo service apache2 restart
      ```

4. **Set up permissions** (if needed):
    ```sh
    chmod -R 755 /path/to/your/project
    ```

## Usage

1. **Access the application**:
    Open your web browser and navigate to the application URL (e.g., `http://localhost/yourproject`).

2. **Register a new user**:
    - Navigate to the registration page and create a new account.
    - An admin must approve your registration before you can log in.

3. **Admin actions**:
    - Log in as an admin to access the admin dashboard.
    - Approve new user registrations and manage book records.

## Project Structure

/path/to/your/project
├── admin
│ ├── create-book.php
│ ├── inactive-users.php
│ ├── users-list.php
├── controllers
│ ├── ActivateUserController.php
│ ├── AddBookToCollectionController.php
│ ├── CollectBookInformation.php
│ ├── EditBookController.php
│ ├── EditProfileController.php
│ ├── LoginController.php
│ ├── RegisterController.php
│ ├── RemoveBookFromCollectionController.php
│ ├── PromoteToAdminController.php
│ ├── CreateBookController.php
│ ├── ActivateUserController.php
│ └── ...
├── css
│ ├── styles.css
├── iamges
│ ├── ...
├── js
│ ├── custom.js
├── models
│ ├── Book.php
│ ├── User.php
│ └── ...
├── templates
│ ├── footer.php
│ ├── header.php
├── views
│ ├── login.php
│ ├── register.php
│ ├── 404.php
│ ├── edit-profile.php
│ ├── edit-book.php
│ ├── my-books.php
│ └── ...
├── db.php
├── .htaccess
├── index.php
├── logout.php
├── home.php
└── ...

## Database Schema

```sql
CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 0,
  `deleted` int(11) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

CREATE TABLE `user_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

## Notes

Ensure your server environment meets the necessary requirements for running PHP applications with MySQL and Apache.
For any issues or contributions, please open an issue or submit a pull request on the project's GitHub repository.
