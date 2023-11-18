<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Estrenos - PelisNow Admin</title>
    <link rel="stylesheet" href="styles.css" />
    <style>
        .carousel {
            width: 600px;
        }

        .carousel-images {
            display: flex;
            width: 200px;
            transition: transform 0.5s ease;
            cursor: pointer;
        }


        .carousel-images img {
            width: 200px;
            flex-shrink: 0;
        }

        .carousel-container {
            width: 200px;
            margin: 0 100px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="navbar-brand">PelisNow</div>
            <div class="navbar-nav">
                <a href="AOAAdminInicio.php" class="nav-item">Inicio</a>
                <a href="AOAAdminPeliculas.php" class="nav-item">Películas</a>
                <a href="AOAAdminCategorias.php" class="nav-item">Categorías</a>
                <a href="AOAAdminDirectores.php" class="nav-item">Directores</a>
                <a href="AOAAdminActores.php" class="nav-item">Actores</a>
                <a href="AOALogin.php" class="nav-item">Logout</a>
            </div>
        </nav>
    </header>
    <div class="movies-container">
        <h1>Estrenos</h1>
        <div class="carousel-container">
            <div id="carouselEstrenos" class="carousel">
                <div class="carousel-images">

                </div>
            </div>
        </div>
    </div>
    <footer class="site-footer">
        <div class="footer-bottom">
            <p>AOA – PW1 – Noviembre/2023</p>
        </div>
    </footer>
    <script src="./assets/js/estrenos.js"></script>
</body>

</html>