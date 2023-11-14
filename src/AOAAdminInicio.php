<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reportes - PelisNow Admin</title>
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
    <h1>Listado de usuarios</h1>
    <div class="add-button-container">
      <a href="/admin/AOARegistroCliente.php" class="add-movie-btn">
        Registrar Nuevo Cliente
      </a>
    </div>
    <table class="movies-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Membresía</th>
          <th>Fecha de registro</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Juan Pérez</td>
          <td>juan.perez@example.com</td>
          <td>Anual</td>
          <td>2022-01-15</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Maria López</td>
          <td>maria.lopez@example.com</td>
          <td>Mensual</td>
          <td>2022-02-20</td>
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