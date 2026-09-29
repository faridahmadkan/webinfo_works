<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My First Laravel Page</title>
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

        a {
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Welcome to My Laravel Website</h1>

        <p>Student: Farid Ahmad Khan</p>
        <p>Course: {{ $course }}</p>
        <p>This is my first Blade view.</p>

        <a href="{{ url('/about') }}">About Me</a>
    </div>
</body>
</html>
