# Book Registration and Viewing (Laravel)

Student-style solution for the lab. Copy these files into your **existing Laravel authentication project**.

## Files
- `app/Models/Book.php`
- `app/Http/Controllers/BookController.php`
- `database/migrations/2026_10_27_000000_create_books_table.php`
- `routes/web.php.example` (merge into existing routes; do not replace login/logout)
- `resources/views/dashboard-books-section.blade.php` (copy into your existing dashboard Blade view)

## Setup
1. Ensure `.env` points to your XAMPP MySQL database.
2. Copy the files and merge routes as described below.
3. Run `php artisan migrate`, then `php artisan route:list`.
4. Run `php artisan serve`, log in, and visit `/dashboard`.

## Routes
Keep your existing auth group and replace its old dashboard route with:
```php
Route::get('/dashboard', [BookController::class, 'index'])->name('dashboard');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
```
Add `use App\Http\Controllers\BookController;` at the top. Keep your existing login/logout routes. Do not add a duplicate dashboard route.

This add-on assumes your existing project already has authentication and a Bootstrap dashboard.
