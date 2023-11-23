<?php


session_start();
include_once('./db.php');
include_once('./aoa_leer_peliculas.php');

$db = new Database();

$peliculas = leerPeliculas($db);
$has_peliculas = count($peliculas) > 0;

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Películas - PelisNow Admin</title>
  <link rel="stylesheet" href="styles.css" />
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
    <h1>Listado de películas</h1>
    <div class="add-button-container">
      <button onclick="location.href='/AOARegistroPelicula.php'" class="add-movie-btn">
        Registrar Nueva Película
      </button>
    </div>
    <?php if ($has_peliculas) { ?>
      <table class="movies-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Director</th>
            <th>Actor 1</th>
            <th>Actor 2</th>
            <th>País</th>
            <th>Año</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($peliculas as $pelicula) { ?>
            <tr>
              <td><?php echo $pelicula['id_pelicula'] ?></td>
              <td><?php echo $pelicula['nombre'] ?></td>
              <td><?php echo $pelicula['categoria'] ?></td>
              <td><?php echo $pelicula['director'] ?></td>
              <td><?php echo $pelicula['actor1']['nombre'] ?></td>
              <td><?php echo $pelicula['actor2']['nombre'] ?></td>
              <td><?php echo $pelicula['pais'] ?></td>
              <td><?php echo $pelicula['anio_lanzamiento'] ?></td>
              <td>
                <a href="/AOARegistroPelicula.php?id=<?php echo $pelicula['id_pelicula'] ?>">Editar</a>
                <a href="/AOAEliminarPelicula.php?id=<?php echo $pelicula['id_pelicula'] ?>">Eliminar</a>
              </td>
            </tr>

          <?php } ?>

        </tbody>
      </table>
    <?php } else { ?>
      <p>No hay películas registradas</p>
    <?php } ?>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>