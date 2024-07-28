<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            background-color: #f3f4f6;
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .links a {
            margin-right: 15px;
            text-decoration: none;
            color: #666;
            font-weight: 600;
        }
        .links a:hover {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>MyKost Admin</h1>
            <p>Silahkan <a href="{{ route('login') }}">Log in</a> untuk masuk</p>
        </div>
    </div>
</body>
</html>