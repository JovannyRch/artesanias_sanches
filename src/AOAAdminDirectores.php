<?php


session_start();

include_once('./db.php');
include_once('./aoa_leer_director.php');

$db = new Database();

$directores = leerDirectores($db);

?>

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
      <button onclick="location.href='/AOARegistroDirector.php'" class="add-movie-btn">
        Registrar Director
      </button>
    </div>
    <table class="movies-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Nacionalidad</th>
          <th>Fecha nacimiento</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($directores as $director) { ?>
          <tr>
            <td><?php echo $director['id_director'] ?></td>
            <td><?php echo $director['nombre'] . ' ' . $director['ap_paterno'] . ' ' . $director['ap_materno'] ?></td>

            <td><?php echo $director['nacionalidad'] ?></td>
            <td><?php echo $director['fecha_nacimiento'] ?></td>
            <td>
              <a href="/AOARegistroDirector.php?id=<?php echo $director['id_director'] ?>">Editar</a>
              <a href="/AOAEliminarDirector.php?id=<?php echo $director['id_director'] ?>">Eliminar</a>
            </td>
          </tr>
        <?php } ?>
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