<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies List</title>

    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- Include any additional stylesheets or scripts here -->
</head>

<body class="container">

    <h1 class="mt-4">Lista de Peliculas</h1>
    <ul>
        <li><a href=/filmout/oldFilms>Pelis antiguas</a></li>
        <li><a href=/filmout/newFilms>Pelis nuevas</a></li>
        <li><a href=/filmout/countFilms>Contador pelis</a></li>
        <li><a href=/filmout/sortFilms>Pelis ordenadas por año</a></li>
    </ul>

    <h2>Buscar películas por año</h2>
    <form action="{{ route('listFilmsByYear') }}" method="GET">
        <label for="year">Año:</label>
        <input type="number" name="year" id="year" required>
        <button type="submit">Buscar</button>
    </form>

    <h2>Buscar películas por género</h2>
    <form action="{{ route('listFilmsByGenre') }}" method="GET">
        <label for="genre">Género:</label>
        <input type="text" name="genre" id="genre" required>
        <button type="submit">Buscar</button>
    </form>

    <h2>Añadir Película</h2>
    <form action="{{ route('createFilm') }}" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="year">Año:</label>
        <input type="number" name="year" id="year" required><br>

        <label for="genre">Género:</label>
        <input type="text" name="genre" id="genre" required><br>

        <label for="country">País:</label>
        <input type="text" name="country" id="country" required><br>

        <label for="duration">Duración (minutos):</label>
        <input type="number" name="duration" id="duration" required><br>

        <label for="img_url">Imagen URL:</label>
        <input type="text" name="img_url" id="img_url" required><br>

        <button type="submit">Enviar</button>
    </form>


    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include any additional HTML or Blade directives here -->
    @if ($errors->any())
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @php
        $errorMessages = implode('\n', $errors->all());
    @endphp
    <script>
        Swal.fire({
            title: "Error",
            text: "{!! $errorMessages !!}",
            icon: "error",
            confirmButtonText: "Aceptar"
        });
    </script>
    @endif



</body>

</html>

