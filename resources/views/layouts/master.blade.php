<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
    body {
        display: flex;
        flex-direction: column;
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
        min-height: 100vh;
    }

    .content {
        min-width: calc(100vw * 2 / 5);
        max-width: calc(100vw * 3 / 5);
        margin: auto;
        padding: 50px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1, h2 {
        color: #333;
        text-align: center;
        margin-bottom: 50px;
    }

    p {
        margin-left: 30px;
    }

    ul {
        margin-bottom: 50px;
        align-items: center
    }

    li {
        align-items: center;
        margin-bottom: 15px;
        list-style: none;
        list-style-image: url('img/search_icon_3.png');
    }

    a {
        color: #8A2BE2;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
        color:rgb(85, 21, 153);
    }

    form {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
        margin-bottom: 50px;
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
        box-sizing: border-box;
    }

    form button {
        background-color: #8A2BE2;
        color: white;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }

    form button:hover {
        background-color: #7A1BE2;
    }

    table {
        border-collapse: collapse;
    }

    th, td {
    padding: 10px;
    text-align: center;
    }

    tr:nth-child(even) {
    background-color:rgb(242, 242, 242);
    }

    tr:hover td {
    background-color: rgb(235, 226, 243); /* Aplica el hover a toda la fila */
    }

    tr:first-child {
    background-color: inherit; /* No aplicar hover al encabezado */
    }

    .films-count {
    font-size: 1.5rem;
    font-weight: bold;
    color: #6A0DAD; 
    background-color: #f0e6f7;
    padding: 5px 10px;
    border-radius: 5px;
    }
</style>


</head>
<body class="container">

    <header style="display: flex; justify-content: center; align-items: center; height: 150px; background: #000; overflow: hidden; margin-bottom: 2px;">
        <img src="{{ url('/img/film_header.jpg') }}" alt="Header Image" style="max-width: 100%; object-fit: cover;">
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer style="display: flex; justify-content: center; align-items: center; height: 100px; background: #000; overflow: hidden; margin-top: auto;">
    <img src="{{ url('/img/film_header.jpg') }}" alt="Footer Image" style="max-width: 100%; object-fit: cover;">
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>
</html>
