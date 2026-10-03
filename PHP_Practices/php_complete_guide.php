<?php
/**
 * PHP: from first principles to production patterns
 * ------------------------------------------------
 * Run from a terminal: php php_complete_guide.php
 * Or open this file through a PHP-enabled web server (for example, XAMPP).
 * This guide targets PHP 8.2+ and uses built-in PHP features only.
 * Each section runs safe examples; database examples use memory-only SQLite when available.
 * This is a broad learning reference, not a substitute for the official PHP manual.
 */

declare(strict_types=1);

$isCli = PHP_SAPI === 'cli';
$browserSectionOpen = false;

// Print escaped, readable output in both a terminal and a browser.
if (!$isCli) {
    header('Content-Type: text/html; charset=UTF-8');
    echo "<!doctype html><html lang=\"en\"><head><meta charset=\"utf-8\">";
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>PHP — From First Principles to Production</title><style>';
    echo 'body{font:16px/1.65 system-ui,-apple-system,Segoe UI,sans-serif;background:#eef2ff;color:#172033;margin:0;padding:clamp(1rem,4vw,3rem)}';
    echo 'main{max-width:980px;margin:auto;background:#fff;padding:clamp(1.25rem,4vw,3rem);border-radius:20px;box-shadow:0 20px 60px #17203318}';
    echo 'header{border-bottom:1px solid #e5e7eb;margin-bottom:2rem;padding-bottom:1.5rem}';
    echo 'header small{color:#6d28d9;font-weight:700;text-transform:uppercase;letter-spacing:.12em}';
    echo 'h1{font-size:clamp(2rem,5vw,3.5rem);line-height:1.1;margin:.5rem 0;color:#312e81}';
    echo 'header p{color:#526078;margin:0}section{margin:2rem 0;padding:1.25rem 1.5rem;border:1px solid #e5e7eb;border-radius:14px;background:#fcfcff}';
    echo 'h2{font-size:1.25rem;color:#4c1d95;margin:0 0 .75rem}pre{white-space:pre-wrap;overflow-wrap:anywhere;margin:0;font:14px/1.7 ui-monospace,SFMono-Regular,Consolas,monospace;color:#263247}';
    echo '@media(max-width:600px){section{padding:1rem;margin:1.25rem 0}}';
    echo '</style></head><body><main><header><small>PHP 8.2+ · Practical learning reference</small>';
    echo '<h1>From First Principles to Production</h1><p>A runnable, commented tour of the language, standard library, application patterns, and security.</p></header><pre>';
}

function printLine(string $text = ''): void
{
    global $isCli;
    echo $isCli ? $text . PHP_EOL : htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "\n";
}

function heading(string $title): void
{
    global $isCli, $browserSectionOpen;
    if (!$isCli) {
        echo '</pre>' . ($browserSectionOpen ? '</section>' : '');
        echo '<section><h2>' . htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</h2><pre>';
        $browserSectionOpen = true;
        return;
    }
    printLine();
    printLine(str_repeat('=', 72));
    printLine($title);
    printLine(str_repeat('=', 72));
}

function showValue(string $label, mixed $value): void
{
    printLine($label . ': ' . var_export($value, true));
}

printLine('PHP — FROM FIRST PRINCIPLES TO PRODUCTION');
printLine('PHP version: ' . PHP_VERSION . ' | Output is escaped for safe browser display.');
printLine('Read the concepts, change the examples, and run this file to observe the results.');
printLine('Guide map: foundations → language → OOP → data/web → security → testing → production.');

heading('1. Output, comments, variables, and data types');
// Comments document code: // one line, # one line, or /* multiple lines */.
// Variables start with $ and are case-sensitive: $name and $Name are different.
$name = 'Farid';                 // string: text
$age = 23;                       // int: whole number
$height = 1.72;                  // float: decimal number
$isStudent = true;               // bool: true or false
$nothing = null;                 // null: deliberately no value

printLine('Hello, PHP!');        // printLine() is a helper defined in this tutorial.
showValue('Name', $name);
showValue('Age', $age);
showValue('Height', $height);
showValue('Student?', $isStudent);
showValue('No value', $nothing);
showValue('Type of age', get_debug_type($age));

const COURSE = 'PHP fundamentals'; // Constants do not use $ and cannot be reassigned.
showValue('Constant COURSE', COURSE);

heading('2. Operators and expressions');
// Arithmetic: + - * / % (remainder) ** (power). Parentheses make order clear.
$first = 17;
$second = 5;
showValue('17 + 5', $first + $second);
showValue('17 / 5', $first / $second);
showValue('17 % 5 (remainder)', $first % $second);
showValue('2 ** 3 (power)', 2 ** 3);

// Assignment operators include +=, -=, *=, /=, and .= (append text).
$message = 'PHP';
$message .= ' is useful';
showValue('After .=', $message);

heading('3. Strings');
// Single quotes mostly keep text literal; double quotes interpolate variables.
$city = 'Kabul';
showValue('Interpolation', "Hello, $name from $city");
showValue('Concatenation with .', 'Hello, ' . $name . '!');
showValue('String length in bytes', strlen('PHP'));
showValue('Uppercase', strtoupper('learn php'));
showValue('Substring search', str_contains('Learn PHP today', 'PHP'));

heading('4. Comparisons, truthiness, and null coalescing');
// Prefer === and !== when both value AND type should match.
showValue("'5' == 5 (loose)", '5' == 5);
showValue("'5' === 5 (strict)", '5' === 5);
showValue('10 >= 5', 10 >= 5);

$optionalNickname = null;
$nickname = $optionalNickname ?? 'Guest'; // Use right side only if left is null/missing.
showValue('Nickname fallback', $nickname);
$isAdult = $age >= 18 ? 'adult' : 'minor'; // Ternary: short if/else expression.
showValue('Age category', $isAdult);

heading('5. Decisions: if, switch, and match');
$score = 84;
if ($score >= 90) {
    $grade = 'A';
} elseif ($score >= 80) {
    $grade = 'B';
} else {
    $grade = 'Needs more practice';
}
showValue('Grade from if/elseif/else', $grade);

// switch handles multiple branches; match (PHP 8+) returns a value and is strict.
$dayNumber = 2;
$switchDay = '';
switch ($dayNumber) {
    case 1:
        $switchDay = 'Monday';
        break; // break prevents execution from falling through into the next case.
    case 2:
        $switchDay = 'Tuesday';
        break;
    default:
        $switchDay = 'Another day';
}
showValue('Day from switch', $switchDay);

$dayName = match ($dayNumber) {
    1 => 'Monday',
    2 => 'Tuesday',
    3 => 'Wednesday',
    default => 'Another day',
};
showValue('Day from match', $dayName);

heading('6. Arrays');
// Indexed arrays use numeric keys; associative arrays use named keys.
$fruits = ['apple', 'banana', 'orange'];
$person = ['name' => 'Ali', 'age' => 20];
$person['city'] = 'Herat';
showValue('Indexed array', $fruits);
showValue('Associative array', $person);
showValue('First fruit', $fruits[0]);
showValue('Person name', $person['name']);

// Nested arrays model structured data. Use ?? to safely read an optional key.
$students = [
    ['name' => 'Ali', 'score' => 91],
    ['name' => 'Sara', 'score' => 87],
];
showValue('Second student score', $students[1]['score'] ?? 'Not available');
[$firstFruit, $secondFruit] = $fruits; // Array destructuring assigns items to variables.
showValue('Destructured fruit', $secondFruit);
showValue('Count', count($fruits));
showValue('Array with an item appended', [...$fruits, 'grape']); // Spread syntax (PHP 7.4+).

heading('7. Loops');
// for: best when you know the counter; while: repeat as long as a condition is true.
$countdown = [];
for ($i = 3; $i >= 1; $i--) {
    $countdown[] = $i;
}
showValue('for loop', $countdown);

$counter = 1;
while ($counter <= 3) {
    printLine('while loop says: ' . $counter);
    $counter++;
}

// do...while always runs its body at least once, then checks the condition.
$attempt = 1;
do {
    printLine('do...while attempt: ' . $attempt);
    $attempt++;
} while ($attempt <= 2);

// foreach is the usual choice for visiting every array item.
foreach ($fruits as $index => $fruit) {
    printLine("foreach item $index: $fruit");
}
// break exits a loop; continue skips to its next iteration.

heading('8. Functions');
// A function packages reusable code. Parameters are inputs; return sends a result back.
function greet(string $who = 'friend'): string
{
    return "Hello, $who!";
}

function addNumbers(int|float $left, int|float $right): int|float
{
    return $left + $right;
}

function total(int ...$numbers): int // ... collects any number of arguments into an array.
{
    return array_sum($numbers);
}

showValue('Default argument', greet());
showValue('Named argument (PHP 8+)', greet(who: 'Sara'));
showValue('Union types (int|float)', addNumbers(2, 3.5));
showValue('Variadic function', total(1, 2, 3, 4));

heading('9. Anonymous functions, arrow functions, and callbacks');
// Closures are functions stored in variables. use (...) imports outer variables.
$taxRate = 0.10;
$addTax = function (float $price) use ($taxRate): float {
    return $price * (1 + $taxRate);
};
showValue('Closure adds 10% tax', round($addTax(100), 2));

// Arrow functions (fn) are concise closures and automatically capture outer values.
$numbers = [1, 2, 3, 4];
$squares = array_map(fn (int $number): int => $number * $number, $numbers);
$largeNumbers = array_filter($numbers, fn (int $number): bool => $number > 2);
showValue('array_map squares', $squares);
showValue('array_filter values > 2', array_values($largeNumbers));

heading('10. Scope, superglobals, and safe user input');
// Local variables belong to a function. Avoid global state when passing an argument works.
// Superglobals include $_GET, $_POST, $_SERVER, $_FILES, $_COOKIE, and $_SESSION.
// They may be empty in CLI; ?? provides a safe default.
$requestedName = $_GET['name'] ?? 'Visitor';
showValue('Example name from ?name=... (or default)', $requestedName);

// Validate data according to what it should be; do not trust browser/user input.
$emailCandidate = 'learner@example.com';
$validEmail = filter_var($emailCandidate, FILTER_VALIDATE_EMAIL);
showValue('Validated email', $validEmail ?: 'Invalid email');
// Escape text when placing it in HTML. This file's printLine() uses htmlspecialchars().

heading('11. JSON');
// JSON is a common format for APIs and configuration. Exceptions make invalid JSON visible.
$json = json_encode($person, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
$decodedPerson = json_decode($json, true, 512, JSON_THROW_ON_ERROR);
showValue('Encoded JSON', $json);
showValue('Decoded JSON array', $decodedPerson);

heading('12. Dates and time');
// DateTimeImmutable is safer for date calculations because operations return new objects.
$today = new DateTimeImmutable('2026-01-01');
showValue('Example date', $today->format('Y-m-d'));
showValue('One week later', $today->modify('+1 week')->format('Y-m-d'));
// Use the actual current time in applications; a fixed date here makes this demo repeatable.

heading('13. Exceptions and error handling');
// Exceptions report exceptional conditions. Catch only errors you can handle meaningfully.
try {
    $dividend = 12;
    $divisor = 0;
    if ($divisor === 0) {
        throw new InvalidArgumentException('The divisor must not be zero.');
    }
    $quotient = $dividend / $divisor;
} catch (InvalidArgumentException $exception) {
    showValue('Caught exception', $exception->getMessage());
} finally {
    printLine('finally runs whether an exception happened or not.');
}
// In production, log technical details privately; show users a safe, helpful message.

heading('14. Safe file handling');
// This demo uses a temporary file and removes it afterward; it does not alter your project.
$temporaryFile = tempnam(sys_get_temp_dir(), 'php-guide-');
if ($temporaryFile === false) {
    printLine('Could not create a temporary file on this system.');
} else {
    try {
        $writtenBytes = file_put_contents($temporaryFile, "A temporary PHP tutorial note.\n");
        if ($writtenBytes === false) {
            throw new RuntimeException('Writing the temporary file failed.');
        }
        $fileContents = file_get_contents($temporaryFile);
        showValue('Temporary file contents', $fileContents === false ? 'Read failed' : trim($fileContents));
    } catch (RuntimeException $exception) {
        showValue('File operation error', $exception->getMessage());
    } finally {
        if (is_file($temporaryFile)) {
            unlink($temporaryFile);
        }
        printLine('Temporary file cleaned up.');
    }
}
// Never use an untrusted path directly. Check permissions and handle failures in real apps.

heading('15. Object-oriented PHP (OOP)');
// A class is a blueprint; an object is an instance. Properties store state; methods do work.
interface Describable
{
    public function describe(): string;
}

trait HasGreeting
{
    public function greeting(): string
    {
        return 'Welcome to the class!';
    }
}

abstract class Account
{
    use HasGreeting;

    public function __construct(
        protected string $accountName,
        private int $accountId,
    ) {
    }

    // Abstract methods must be implemented by a non-abstract child class.
    abstract public function accountType(): string;

    public function summary(): string
    {
        return $this->accountName . ' (#' . $this->accountId . ')';
    }
}

final class StudentAccount extends Account implements Describable
{
    public function accountType(): string
    {
        return 'Student';
    }

    public function describe(): string
    {
        return $this->accountType() . ' account: ' . $this->summary();
    }
}

$account = new StudentAccount(accountName: 'Ali', accountId: 101);
showValue('Object method', $account->describe());
showValue('Trait method', $account->greeting());
// public: accessible anywhere; protected: class and children; private: declaring class only.
// Inheritance uses extends; interfaces use implements; traits reuse method implementations.

heading('16. Database access: PDO, parameters, and transactions');
// Parameterized queries keep data separate from SQL syntax and prevent SQL injection.
// This sample uses a temporary in-memory SQLite database if the PDO driver is installed.
if (in_array('sqlite', PDO::getAvailableDrivers(), true)) {
    $pdo = new PDO('sqlite::memory:', options: [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    $pdo->exec('CREATE TABLE students (id INTEGER PRIMARY KEY, name TEXT NOT NULL)');
    $insertStudent = $pdo->prepare('INSERT INTO students (name) VALUES (:name)');

    try {
        $pdo->beginTransaction();
        foreach (['Ali', 'Sara'] as $studentName) {
            $insertStudent->execute(['name' => $studentName]);
        }
        $pdo->commit(); // Commit makes all transaction changes permanent (in this memory DB).
    } catch (Throwable $exception) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack(); // Roll back the whole unit of work if anything failed.
        }
        showValue('Database example error', $exception->getMessage());
    }

    $findStudent = $pdo->prepare('SELECT id, name FROM students WHERE name = :name');
    $findStudent->execute(['name' => 'Sara']);
    showValue('Prepared query result', $findStudent->fetch());
} else {
    printLine('PDO SQLite is not enabled here; the example was safely skipped.');
    printLine('See PDO::getAvailableDrivers() to discover drivers enabled in a PHP installation.');
}
// For MySQL, use a DSN like mysql:host=localhost;dbname=school;charset=utf8mb4.
// Keep credentials outside source code; configure timeouts and least-privilege DB users.
// One transaction should represent one logical unit of work; handle rollback on failure.

heading('17. Modern PHP types and language features');
// PHP 8.2+ includes enums and readonly classes. Types improve contracts and tooling.
enum OrderStatus: string
{
    case Pending = 'pending';
    case Paid = 'paid';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::Pending => 'Awaiting payment',
            self::Paid => 'Paid',
            self::Cancelled => 'Cancelled',
        };
    }
}

readonly class Money
{
    public function __construct(
        public int $minorUnits,
        public string $currency = 'USD',
    ) {
        if ($minorUnits < 0) {
            throw new InvalidArgumentException('Money cannot be negative in this example.');
        }
    }

    public function format(): string
    {
        return $this->currency . ' ' . number_format($this->minorUnits / 100, 2);
    }
}

$orderStatus = OrderStatus::Paid;
$money = new Money(1299);
showValue('Enum name/value/label', [$orderStatus->name, $orderStatus->value, $orderStatus->label()]);
showValue('Backed enum lookup', OrderStatus::tryFrom('pending')?->label());
showValue('Readonly value object', $money->format());
// Nullable types: ?User; unions: int|string; intersections: A&B; DNF combines both.
// Use PHPDoc for generic array shapes and collection types that PHP cannot express natively.
// `mixed` is an escape hatch; `never` means a function does not return; `void` returns no value.
// Prefer domain types over unvalidated associative arrays at application boundaries.

heading('18. Object design: contracts, composition, and dependency injection');
interface Clock
{
    public function now(): DateTimeImmutable;
}

final class SystemClock implements Clock
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable('now', new DateTimeZone('UTC'));
    }
}

final class ReceiptService
{
    public function __construct(private Clock $clock)
    {
    }

    public function createdAt(): string
    {
        return $this->clock->now()->format(DateTimeInterface::ATOM);
    }
}

$receiptService = new ReceiptService(new SystemClock());
showValue('Dependency injected UTC clock', $receiptService->createdAt());
// The service depends on an abstraction (Clock), not a concrete global clock.
// Tests can inject a fixed clock; production can inject a system clock.
// Prefer composition for behavior reuse; inherit only for a genuine "is-a" relationship.
// Keep objects invariant-valid: construct valid state and expose purposeful methods.

heading('19. Generators, iterables, and lazy processing');
// yield produces values one at a time instead of building a whole result array in memory.
function positiveNumbers(int $limit): Generator
{
    for ($number = 1; $number <= $limit; $number++) {
        yield $number;
    }
}

$generated = [];
foreach (positiveNumbers(5) as $number) {
    $generated[] = $number;
}
showValue('Values consumed from a generator', $generated);
// A generator is useful for large files, database cursors, and paginated feeds.
// Generators are single-pass; calling iterator_to_array() can consume their memory advantage.

heading('20. Attributes and reflection');
// Attributes attach structured metadata to declarations; Reflection reads it at runtime.
#[Attribute(Attribute::TARGET_CLASS)]
final class TableName
{
    public function __construct(public string $name)
    {
    }
}

#[TableName('customer_records')]
final class CustomerRecord
{
}

$classMetadata = (new ReflectionClass(CustomerRecord::class))
    ->getAttributes(TableName::class)[0]
    ->newInstance();
showValue('Attribute metadata', $classMetadata->name);
// Reflection powers frameworks, dependency containers, serializers, and test tools.
// Do not build fragile applications by reflecting everything when explicit code is clearer.

heading('21. Fibers and concurrency concepts');
// A Fiber can suspend and resume a call stack. A Fiber alone does not make I/O asynchronous;
// an event loop or async library must schedule fibers and provide non-blocking I/O.
$fiber = new Fiber(static function (): string {
    $resumeValue = Fiber::suspend('Fiber paused at this value.');
    return 'Fiber resumed with: ' . $resumeValue;
});
$suspendedValue = $fiber->start();
showValue('Fiber suspension value', $suspendedValue);
$fiber->resume('continue');
showValue('Fiber final return value', $fiber->getReturn());
// Fibers are cooperative, not parallel threads. CPU-heavy work still blocks the process.

heading('22. Regular expressions and Unicode');
// PCRE regular expressions are powerful; delimit patterns and escape user-provided patterns.
$phone = '+1-555-0100';
$phoneIsPlausible = preg_match('/^\+?[0-9][0-9 -]{5,20}$/', $phone) === 1;
showValue('Phone format match', $phoneIsPlausible);
showValue('Replace repeated whitespace', preg_replace('/\s+/', ' ', 'PHP   is   readable'));
// strlen() counts bytes, not user-perceived characters for UTF-8 text.
showValue('UTF-8 extension available?', extension_loaded('mbstring'));
if (function_exists('mb_strlen')) {
    showValue('Unicode character count', mb_strlen('café', 'UTF-8'));
}
// Validate input and impose length limits; regex is not a substitute for HTML escaping.

heading('23. Dates, time zones, and deterministic tests');
// Store instants in UTC; convert to a user's time zone only for display.
$instant = new DateTimeImmutable('2026-10-03T12:00:00+00:00');
$newYorkTime = $instant->setTimezone(new DateTimeZone('America/New_York'));
showValue('UTC instant', $instant->format(DateTimeInterface::ATOM));
showValue('Same instant in New York', $newYorkTime->format(DateTimeInterface::ATOM));
// Use DateTimeImmutable and inject clocks to make application logic and tests predictable.
// Be careful with daylight-saving transitions and recurring local-time schedules.

heading('24. Passwords, cryptographic randomness, and secrets');
// Passwords must be hashed, never encrypted or stored as plain text.
$passwordHash = password_hash('correct horse battery staple', PASSWORD_DEFAULT);
showValue('Password verification', password_verify('correct horse battery staple', $passwordHash));
showValue('Secure random integer sample', random_int(1000, 9999));
// password_hash() stores algorithm/cost metadata; verify with password_verify().
// Rehash after successful login when password_needs_rehash() says policy has changed.
// Use random_bytes() or random_int() for security tokens; never use rand() for secrets.
// Store API keys in a secret manager/environment, rotate them, and never log them.

heading('25. Web requests, forms, sessions, and cookies');
// HTTP is stateless: each request is separate. GET is for retrieval; POST changes state.
// $_GET / $_POST are untrusted input. Validate shape, type, length, and allowed values.
$formInput = ['quantity' => '3']; // Simulated form data; not taken from the request.
$quantity = filter_var($formInput['quantity'], FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1, 'max_range' => 20],
]);
showValue('Validated form quantity', $quantity === false ? 'Invalid quantity' : $quantity);
// In a template, escape output for its context: htmlspecialchars($value, ENT_QUOTES, 'UTF-8').
// For state-changing forms, generate a random CSRF token, store it in the session,
// submit it as a hidden field, compare it with hash_equals(), then rotate it when appropriate.
// Session starter (must execute before output, with secure cookie settings):
// session_start(['cookie_httponly' => true, 'cookie_secure' => true, 'cookie_samesite' => 'Lax']);
// $_SESSION['user_id'] = $authenticatedUserId; // Store minimal server-side session state.
// For login, regenerate the session ID after authentication; enforce authorization per action.
// Cookies are client-controlled: never trust a cookie as proof of identity without validation.

heading('26. Uploads, paths, and safe file operations');
// An uploaded filename and MIME type are untrusted. Validate size/error, inspect content,
// generate a server-side name, and store outside the public web root when possible.
// Example outline (adapt and test before use):
// if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK
//     && $_FILES['avatar']['size'] <= 2_000_000) {
//     $mime = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['avatar']['tmp_name']);
//     if (in_array($mime, ['image/jpeg', 'image/png'], true)) {
//         $safeName = bin2hex(random_bytes(16)) . '.img';
//         move_uploaded_file($_FILES['avatar']['tmp_name'], $privateDir . '/' . $safeName);
//     }
// }
// Prevent path traversal: map user choices to known IDs/paths; do not concatenate raw paths.
// Avoid exposing upload storage as executable PHP. Apply least-privilege filesystem permissions.
printLine('Upload outline is commented: it requires a real multipart form and private storage.');

heading('27. PHP errors, exceptions, and diagnostics');
// PHP engine errors, warnings, and exceptions are distinct; all throwables implement Throwable.
// Convert a narrowly scoped warning to an exception when an API reports failure via warnings.
set_error_handler(static function (int $severity, string $message): never {
    throw new ErrorException($message, 0, $severity);
});
try {
    trigger_error('Demonstration warning converted to an exception.', E_USER_WARNING);
} catch (ErrorException $exception) {
    showValue('Converted warning', $exception->getMessage());
} finally {
    restore_error_handler(); // Always restore process-global error handling configuration.
}
// Development: display errors and use E_ALL. Production: hide details from users and log them.
// Catch specific exception types; do not silently swallow Throwable or return fake success.

heading('28. Serialization, streams, and interoperability');
// JSON is usually the safe interchange format for APIs. PHP serialize() is PHP-specific.
$serializedJson = json_encode(['ok' => true, 'count' => 3], JSON_THROW_ON_ERROR);
showValue('JSON for interchange', $serializedJson);
// Never unserialize untrusted input: object deserialization can trigger dangerous magic methods.
// PHP streams unify files, memory, and network resources; wrappers have different security rules.
$memoryStream = fopen('php://memory', 'r+');
if ($memoryStream !== false) {
    fwrite($memoryStream, 'stream data');
    rewind($memoryStream);
    showValue('php://memory stream', stream_get_contents($memoryStream));
    fclose($memoryStream);
}
// Avoid allowing untrusted input to choose a stream wrapper or remote URL.

heading('29. CLI, environment, and process configuration');
// CLI scripts receive arguments in $argv; environment variables are read with getenv().
$safeEnvironmentExample = getenv('APP_ENV') ?: 'not set';
showValue('APP_ENV', $safeEnvironmentExample);
showValue('CLI argument count', isset($argv) ? count($argv) : 0);
// Use exit codes: 0 means success; non-zero reports failure to shells and automation.
// Never expose secrets via command-line arguments where process listings may reveal them.
// php.ini controls extensions, memory_limit, upload limits, error reporting, and more.
// Check the actual SAPI configuration with php --ini / phpinfo() (never publish phpinfo()).

heading('30. Composer, namespaces, autoloading, and standards');
printLine('Composer manages dependencies and generates an autoloader from composer.json.');
printLine('Use PSR-4 namespaces and autoloading instead of manually requiring every class file.');
printLine('Follow PSR-12 style consistently; add PHPDoc for generics, array shapes, and intent.');
printLine('Use a lock file in applications to reproduce dependency versions across environments.');
printLine('Review dependency licenses, advisories, update policy, and supply-chain provenance.');
// Example composer.json mapping (illustrative; this file itself needs no dependencies):
// { "autoload": { "psr-4": { "App\\": "src/" } } }
// After changing autoload mappings, regenerate Composer's autoloader.

heading('31. Testing, static analysis, and code quality');
// Test behavior, not implementation details. A small explicit assertion helper works anywhere.
function expectSame(mixed $expected, mixed $actual, string $description): void
{
    if ($expected !== $actual) {
        throw new RuntimeException($description . ' failed.');
    }
    printLine('PASS: ' . $description);
}

expectSame(5, addNumbers(2, 3), 'integer addition');
expectSame('Hello, learner!', greet('learner'), 'greeting');
expectSame(OrderStatus::Paid, OrderStatus::from('paid'), 'backed enum round trip');
// For projects, PHPUnit or Pest covers unit/feature tests; run tests in CI on supported PHP.
// Static analysis (PHPStan/Psalm), formatting, and coding-standard checks catch defects early.
// Add boundary, failure, authorization, and security tests—not only the happy path.

heading('32. Performance, observability, and production readiness');
// Optimize measured bottlenecks. Algorithmic complexity usually matters more than micro-tuning.
$startTime = hrtime(true);
$sum = array_sum(range(1, 1000));
$elapsedNanoseconds = hrtime(true) - $startTime;
showValue('Measured sample result', $sum);
showValue('Measured sample duration (ns; machine-dependent)', $elapsedNanoseconds);
// Enable OPcache in production; use a profiler before optimizing; inspect DB query plans.
// Watch for N+1 database queries, unbounded input, unbounded memory, and slow external calls.
// Emit structured logs without credentials/PII; add metrics, traces, health checks, and alerts.
// Keep production configuration separate; deploy reproducibly and practice rollback/recovery.

heading('33. Security review checklist');
printLine('• Validate all input; escape at output using the correct HTML/URL/JS/SQL context.');
printLine('• Use prepared SQL, CSRF defenses, secure sessions, password_hash(), and authorization checks.');
printLine('• Restrict file uploads, filesystem paths, network egress, and resource consumption.');
printLine('• Keep secrets out of source control and logs; use HTTPS and secure cookie flags.');
printLine('• Update PHP and dependencies; monitor advisories; handle errors without leaking internals.');
printLine('• Use defense in depth; a security filter is not a replacement for correct design.');

heading('34. Organizing real PHP projects');
printLine('• Put reusable code in files and load it with require_once or Composer autoloading.');
printLine('• Use namespaces to prevent class-name collisions: namespace School\\Models;');
printLine('• Separate presentation, application logic, and data access as projects grow.');
printLine('• Use Composer for dependencies, PHPUnit for tests, and Git for version control.');
printLine('• Keep secrets out of source control; use environment configuration.');

heading('35. Learning path: beginner to expert');
printLine('Beginner: syntax, types, conditions, loops, arrays, functions, and simple classes.');
printLine('Builder: HTTP/forms, validation, templates, sessions, PDO, Composer, and testing.');
printLine('Advanced: type systems, design boundaries, security, performance, profiling, and deployment.');
printLine('Expert: study RFCs, language internals, extension APIs, architecture trade-offs, and real failures.');
printLine('Practice changing values, adding array items, writing functions, and creating classes.');
printLine('Use the official PHP manual and release migration guides to verify version-specific behavior.');
printLine('No single file can literally contain all of PHP, its extensions, and every ecosystem library.');
printLine('End of guide.');

if (!$isCli) {
    echo '</pre>' . ($browserSectionOpen ? '</section>' : '') . '</main></body></html>';
}