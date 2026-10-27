# Book Registration System

A small Laravel project made in a straightforward student-assignment style. It lets a user register books, see the saved list, and delete a book. It uses Laravel's normal MVC structure and keeps the framework's usual starter files.

## Requirements

- PHP 8.2 or newer
- Composer
- MySQL and phpMyAdmin (XAMPP is fine)
- A PHP installation with the PDO MySQL extension enabled

## Run the project

1. Extract the ZIP and open the project folder in VS Code.
2. Open a terminal in that folder and run:

   ```bash
   composer install
   ```

3. Copy `.env.example` to `.env` (on Windows, you can copy it manually).
4. Create a MySQL database named `book_registration` in phpMyAdmin.
5. Check the database values in `.env`. For a default XAMPP installation, `DB_USERNAME=root` and `DB_PASSWORD=` are common settings.
6. Run these commands:

   ```bash
   php artisan key:generate
   php artisan migrate
   php artisan serve
   ```

7. Open `http://127.0.0.1:8000/books` in your browser.

## Main project files

- `app/Models/Book.php` — book model
- `app/Http/Controllers/BookController.php` — list, create and delete actions
- `database/migrations/2026_10_27_000000_create_books_table.php` — books table
- `resources/views/books/index.blade.php` — form and book list
- `routes/web.php` — web routes

## Notes

- The `vendor/` folder is intentionally not included; Composer creates it with `composer install`.
- `.env` is not included because it contains machine-specific settings. Use `.env.example` as the template.
- This project targets Laravel 12. Use a compatible PHP version and let Composer install the framework dependencies.
