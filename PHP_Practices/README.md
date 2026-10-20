# PHP Practices

A progressive PHP learning folder: start with a small first-day program, then use the comprehensive guide as a runnable reference from beginner concepts through production concerns.

## Contents

### [`day1.php`](day1.php)
A first PHP exercise covering:

- Output with `echo` and PHP comments
- Variables and common scalar values
- Arithmetic and comparisons
- `if` / `elseif` / `else` conditions and logical operators
- `for`, `while`, and `foreach` loops
- Classes, objects, properties, methods, and constructors

This file preserves the original beginner exercise. It is intentionally short and is a good place to make your first edits.

### [`php_complete_guide.php`](php_complete_guide.php)
A 35-chapter, commented PHP 8.2+ learning reference. It includes runnable examples for:

1. Output, comments, variables, and types
2. Operators, strings, comparisons, and decisions
3. Arrays, loops, functions, closures, and callbacks
4. Input validation, JSON, dates, exceptions, and safe file handling
5. OOP, PDO, transactions, modern types, enums, and readonly classes
6. Dependency injection, generators, attributes/reflection, and Fibers
7. Unicode, passwords, web forms, sessions, cookies, and uploads
8. Error handling, streams, CLI, Composer, testing, performance, and security
9. A beginner-to-expert learning path

The examples are designed to be safe to run. The database example uses an in-memory SQLite database only when the PDO SQLite driver is available. Session and upload examples are explanatory templates because those features need a real web request and application configuration.

## Requirements

- PHP **8.2 or newer** for the complete guide.
- No Composer packages are required.
- PDO SQLite is optional; without it, that database demonstration reports that it was skipped.
- A terminal is enough for the command-line examples. XAMPP or another PHP-enabled web server can display the complete guide in a browser.

## Run the examples

From the repository root:

```powershell
php PHP_Practices/day1.php
php PHP_Practices/php_complete_guide.php
```

Or with XAMPP running, visit:

- `http://localhost/webinfo_works/PHP_Practices/php_complete_guide.php`

The beginner file uses `<br>` tags for browser output, so its terminal output is less formatted. The complete guide detects CLI versus web-server execution and formats output accordingly.

## Suggested learning order

1. Read `day1.php` and predict what each statement will print.
2. Change its values, add another condition, and write a loop of your own.
3. Read the matching fundamentals chapters in `php_complete_guide.php` and run it.
4. Work through the guide in order, modifying the examples and observing the output.
5. Build a small project using forms, validation, prepared PDO queries, and tests before exploring frameworks.
6. Consult the official PHP manual and migration guides for details and version-specific behavior.

## Coming up

These are planned next practice files; they are **not implemented yet**:

- `day2.php` — arrays, string functions, and reusable functions with focused exercises
- `day3.php` — forms, `$_GET` / `$_POST`, validation, and safe output escaping
- `day4.php` — MySQL with PDO, prepared statements, CRUD operations, and transactions
- `day5.php` — OOP practice: encapsulation, inheritance, interfaces, traits, and composition
- `day6.php` — sessions, authentication concepts, password hashing, and CSRF protection
- `mini_project/` — a small student-record app tying together validation, PDO, and tests

The order may change as the practice material grows. Keep this README in sync when adding or renaming lessons.

## Safety notes

- Never put real passwords, API keys, or database credentials in source files.
- Treat request data, cookies, uploaded files, and filenames as untrusted.
- Use PDO prepared statements for SQL values; escape output for its destination context.
- Do not publish `phpinfo()` output or expose detailed production errors to users.
- The guide is a learning resource, not a claim that one file can cover every PHP extension, library, framework, or edge case.
