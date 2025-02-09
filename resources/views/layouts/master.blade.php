<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    .content {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        color: #333;
        text-align: center;
        margin-bottom: 20px;
    }

    a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    form {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
    }

    form label {
        font-weight: bold;
    }

    form input, form button {
        width: 100%;
        margin: 8px 0;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    form button {
        background-color: #007bff;
        color: white;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #0056b3;
    }
</style>


</head>
<body class="container">

    <header style="display: flex; justify-content: center; align-items: center; height: 150px; background: #000;">
        <img src="{{ url('/img/film_header.jpg') }}" alt="Header Image" style="max-width: 100%; max-height: 100%; object-fit: contain;">
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer style="display: flex; justify-content: center; align-items: center; height: 100px; background: #000; margin-top: 20px;">
    <img src="{{ url('/img/film_footer.jpg') }}" alt="Footer Image" style="max-width: 100%; max-height: 100%; object-fit: contain;">
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>
</html>
