<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Películas Vistas - PelisNow</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="navbar-brand">PelisNow</div>
      <div class="navbar-nav">
        <a href="AOAInicio.php" class="nav-item">Películas Disponibles</a>
        <a href="AOAEstrenos.php" class="nav-item">Estrenos</a>
        <a href="AOAPeliculasVistas.php" class="nav-item">Películas Vistas</a>
        <a href="AOALogin.php" class="nav-item">Logout</a>
      </div>
    </nav>
  </header>

  <div class="movies-container">
    <h1>Películas Vistas</h1>
    <table class="movies-table">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Fecha de Visualización</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <img src="https://cdn.marvel.com/content/1x/marvels_imax_digital_supplemental_v3_lg.jpg" alt="The Marvels" class="movie-image" />
          </td>
          <td>The Marvels</td>
          <td>12/10/2023</td>
          <td>
            <button type="button" onclick="reproducirPelicula('idPelicula1')" class="btn-watch-again">
              Ver de Nuevo
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <script>
    function reproducirPelicula(idPelicula) {
      window.location.href = "AOAReproducir.php?id=" + idPelicula;
    }
  </script>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>