<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .container {
            max-width: 600px; margin: 80px auto; padding: 30px;
            background: white; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        button {
            padding: 10px 20px; background: #dc3545; color: white;
            border: none; border-radius: 4px; cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        button:hover { background: #a71d2a; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You are logged in.</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</body>
</html>
