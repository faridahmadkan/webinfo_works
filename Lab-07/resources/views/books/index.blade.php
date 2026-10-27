<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Registration</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; font-family: Arial, sans-serif; background: #f4f6f9; color: #243047; }
        header { background: #234a78; color: white; padding: 22px 6%; }
        header h1 { margin: 0; font-size: 25px; font-weight: 600; }
        main { max-width: 1050px; margin: 30px auto; padding: 0 18px; }
        .card { background: white; border: 1px solid #e1e6ed; border-radius: 8px; padding: 22px; margin-bottom: 24px; box-shadow: 0 3px 10px #15253a0b; }
        h2 { margin-top: 0; font-size: 20px; }
        .form-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        label { display: block; margin-bottom: 7px; font-size: 14px; }
        input { width: 100%; padding: 10px; border: 1px solid #cbd3df; border-radius: 5px; font-size: 15px; }
        button { border: 0; border-radius: 5px; padding: 10px 15px; background: #234a78; color: white; cursor: pointer; }
        .submit-row { margin-top: 16px; }
        .alert { padding: 12px 14px; border-radius: 5px; margin-bottom: 18px; background: #e4f6e9; color: #176332; }
        .errors { background: #fff0f0; color: #9a2020; padding: 12px 30px; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { text-align: left; padding: 12px; border-bottom: 1px solid #e5e9ef; }
        th { background: #f0f3f7; font-size: 14px; }
        .delete { background: #a63d40; padding: 7px 10px; }
        .empty { color: #687589; padding: 18px 0; }
        footer { text-align: center; padding: 20px; color: #778195; font-size: 13px; }
        @media (max-width: 700px) { .form-grid { grid-template-columns: 1fr; } .table-wrap { overflow-x: auto; } }
    </style>
</head>
<body>
<header><h1>Book Registration System</h1></header>
<main>
    @if (session('success')) <div class="alert">{{ session('success') }}</div> @endif
    @if ($errors->any())
        <div class="errors"><strong>Please check the following:</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    <section class="card">
        <h2>Register a New Book</h2>
        <form method="POST" action="{{ route('books.store') }}">
            @csrf
            <div class="form-grid">
                <div><label for="title">Book title</label><input id="title" name="title" value="{{ old('title') }}" maxlength="150" required></div>
                <div><label for="author">Author name</label><input id="author" name="author" value="{{ old('author') }}" maxlength="100" required></div>
                <div><label for="pages">Number of pages</label><input id="pages" name="pages" type="number" min="1" max="10000" value="{{ old('pages') }}" required></div>
            </div>
            <div class="submit-row"><button type="submit">Register Book</button></div>
        </form>
    </section>
    <section class="card">
        <h2>Registered Books</h2>
        @if ($books->isEmpty())
            <p class="empty">No books have been registered yet. Use the form above to add the first book.</p>
        @else
            <div class="table-wrap"><table><thead><tr><th>No.</th><th>Title</th><th>Author</th><th>Pages</th><th>Registered</th><th>Action</th></tr></thead><tbody>
            @foreach ($books as $book)
                <tr><td>{{ $loop->iteration }}</td><td>{{ $book->title }}</td><td>{{ $book->author }}</td><td>{{ $book->pages }}</td><td>{{ $book->created_at->format('d M Y') }}</td><td><form method="POST" action="{{ route('books.destroy', $book) }}" onsubmit="return confirm('Delete this book?')">@csrf @method('DELETE')<button class="delete" type="submit">Delete</button></form></td></tr>
            @endforeach
            </tbody></table></div>
        @endif
    </section>
</main>
<footer>Book Registration System · Student Project</footer>
</body>
</html>
