<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Inicio - PelisNow</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="navbar-brand">PelisNow</div>
      <div class="navbar-nav">
        <a href="AOAInicio.php" class="nav-item">Películas Disponibles</a>
        <a href="AOAPeliculasVistas.php" class="nav-item">Películas Vistas</a>
        <a href="AOALogin.php" class="nav-item">Logout</a>
      </div>
    </nav>
  </header>
  <div class="movies-container">
    <h1>Listado de Películas</h1>
    <table class="movies-table">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Año</th>
          <th>Clasificación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <img src="https://image.tmdb.org/t/p/w185/aZXHjmhSSGUshLEdgsNCTH9z7Ix.jpg" alt="El Viaje Fantástico" class="movie-image" />
          </td>
          <td>Los asesinos de la luna</td>
          <td>Aventura</td>
          <td>2021</td>
          <td>PG-13</td>
          <td>
            <button type="button" class="btn-play" onclick="reproducirPelicula('idPelicula1')">
              Reproducir
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <img src="https://image.tmdb.org/t/p/w185/7cpAXiwsdFx6GGU0TBGRvDYJuRQ.jpg" alt="Las Sombras de Ayer" class="movie-image" />
          </td>
          <td>Freelance</td>
          <td>Drama</td>
          <td>2020</td>
          <td>R</td>
          <td>
            <button type="button" class="btn-play" onclick="reproducirPelicula('idPelicula1')">
              Reproducir
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <img src="https://image.tmdb.org/t/p/w185/keTEWhBJ4V7hitpsSYC11u0wrIr.jpg" alt="Risas en el Espacio" class="movie-image" />
          </td>
          <td>El año del tigre</td>
          <td>Comedia</td>
          <td>2022</td>
          <td>PG</td>
          <td>
            <button type="button" class="btn-play" onclick="reproducirPelicula('idPelicula1')">
              Reproducir
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