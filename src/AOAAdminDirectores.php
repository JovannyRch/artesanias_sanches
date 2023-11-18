<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Directores - PelisNow Admin</title>
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
    <h1>Listado de directores</h1>
    <div class="add-button-container">
      <button onclick="location.href='/admin/AOARegistroDirector.php'" class="add-movie-btn">
        Registrar Director
      </button>
    </div>
    <table class="movies-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Nacionalidad</th>
          <th>Fecha nacimiento</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Hayao Miyazaki</td>
          <td>hayao.miyazaki@example.com</td>
          <td>Japonesa</td>
          <td>1941-01-05</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>Chava Cartas</td>
          <td>chava.cartas@example.com</td>
          <td>Mexicano</td>
          <td>1971-09-15</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>3</td>
          <td>Nia DaCosta</td>
          <td>nia.dacosta@example.com</td>
          <td>Estado Unidense</td>
          <td>1989-11-08</td>
          <td>
            <button class="btn-play">Editar</button>
            <button class="btn-play">Eliminar</button>
          </td>
        </tr>
        <tr>
          <td>4</td>
          <td>Cal Brunker</td>
          <td>cal.brunker@example.com</td>
          <td>Mexicana</td>
          <td>1978-11-16</td>
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