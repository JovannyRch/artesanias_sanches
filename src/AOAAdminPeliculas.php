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
      <button onclick="location.href='/admin/AOARegistroPelicula.php'" class="add-movie-btn">
        Registrar Nueva Película
      </button>
    </div>
    <table class="movies-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Categoría</th>
          <th>Director</th>
          <th>País</th>
          <th>Año</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>El Viaje de Chihiro</td>
          <td>Animación</td>
          <td>Hayao Miyazaki</td>
          <td>Japón</td>
          <td>2001</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>El Viaje de Chihiro</td>
          <td>Animación</td>
          <td>Hayao Miyazaki</td>
          <td>Japón</td>
          <td>2001</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>El Viaje de Chihiro</td>
          <td>Animación</td>
          <td>Hayao Miyazaki</td>
          <td>Japón</td>
          <td>2001</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>El Viaje de Chihiro</td>
          <td>Animación</td>
          <td>Hayao Miyazaki</td>
          <td>Japón</td>
          <td>2001</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>