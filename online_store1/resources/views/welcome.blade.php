<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guiao Furniture Shop</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header class="bg-danger text-white py-5">
        
    </header>

    <div class="container mt-4">
        <div class="text-center mb-4">
            <img src="{{ asset('Guiao Logo2.png') }}" alt="Guiao Logo" class="img-fluid" style="max-width: 300px;">
        </div>

        <div class="bg-white p-4 rounded-lg shadow-lg text-center">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-lg mr-2">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-success btn-lg mr-2">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-danger btn-lg">Register</a>
                @endif
            @endauth
        </div>
    </div>


    <!-- Bootstrap JS and dependencies (optional, for components like modals, etc.) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
