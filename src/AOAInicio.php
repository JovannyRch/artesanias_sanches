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
          <th>Actores</th>
          <th>Categoría</th>
          <th>Año</th>
          <th>Clasificación</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <img src="https://es.web.img2.acsta.net/pictures/21/05/11/13/47/5979708.jpg" alt="El Viaje de Chihiro" class="movie-image" />
          </td>
          <td>El Viaje de Chihiro</td>
          <td>Rumi Hiiragi, Jason Marsden</td>
          <td>Animación</td>
          <td>2001</td>
          <td>PG-13</td>
          <td>
            <button type="button" class="btn-play" onclick="reproducirPelicula('idPelicula1')">
              Reproducir
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <img src="https://dx35vtwkllhj9.cloudfront.net/paramountpictures/paw-patrol-the-mighty-movie/images/regions/ar/onesheet.jpg" alt="Paw Patrol" class="movie-image" />
          </td>
          <td>Paw Patrol</td>
          <td>Kim Kardashian, Ron Pardo</td>
          <td>Animación</td>
          <td>2023</td>
          <td>PG</td>
          <td>
            <button type="button" class="btn-play" onclick="reproducirPelicula('idPelicula1')">
              Reproducir
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <img src="https://cdn.marvel.com/content/1x/marvels_imax_digital_supplemental_v3_lg.jpg" alt="The Marvels" class="movie-image" />
          </td>
          <td>The Marvels</td>
          <td>Brie Larson, Isman Vellani</td>
          <td>Acción</td>
          <td>2023</td>
          <td>PG-13</td>
          <td>
            <button type="button" class="btn-play" onclick="reproducirPelicula('idPelicula1')">
              Reproducir
            </button>
          </td>
        </tr>
        <tr>
          <td>
            <img src="https://static.cinepolis.com/resources/mx/movies/posters/414x603/43329-183342-20230811032620.jpg" alt="Sobreviviendo a mis XV" class="movie-image" />
          </td>
          <td>Sobreviviendo a mis XV</td>
          <td>Memo Villegas, Verónica Bravo</td>
          <td>Comedia</td>
          <td>2023</td>
          <td>PG-13</td>
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