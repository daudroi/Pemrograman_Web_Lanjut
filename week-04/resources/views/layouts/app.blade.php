<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>WedBook - Jobsheet 04 Eloquent ORM</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; background: #f9f9f9; }
        h1   { color: #6a1a3a; }
        .nav a { margin-right: 15px; color: #6a1a3a; font-weight: bold; text-decoration: none; }
        .nav a:hover { text-decoration: underline; }
        table { border-collapse: collapse; width: 100%; background: white; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        th { background: #6a1a3a; color: white; }
        tr:nth-child(even) { background: #f2e8ec; }
    </style>
</head>
<body>
    <h1>💒 WedBook - Studi Kasus Eloquent ORM</h1>
    <div class="nav">
        <a href="/">Home</a>
        <a href="/event">Events (Praktikum 4.1)</a>
        <a href="/guest">Guests &amp; RSVP (Praktikum 4.2)</a>
    </div>
    <hr>
    @yield('content')
</body>
</html>
