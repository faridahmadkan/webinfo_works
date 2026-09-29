<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Me</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .box {
            max-width: 700px;
            margin: auto;
            padding: 25px;
            background: white;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>About Me</h1>

        <p><strong>Name:</strong> Farid Ahmad Khan</p>
        <p><strong>Student ID:</strong> __________________</p>

        <p>I want to learn how to build web applications using Laravel.</p>
        <p>I also want to understand routes, Blade views, and how Laravel projects are organized.</p>

        <a href="{{ url('/') }}">Back to Home</a>
    </div>
</body>
</html>
