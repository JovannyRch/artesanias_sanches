<?php


session_start();

include_once('./db.php');
include_once('./aoa_leer_actor.php');

$db = new Database();

$actores = leerActores($db);

$has_items = count($actores) > 0;

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Actores - PelisNow Admin</title>
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
    <h1>Listado de actores</h1>
    <div class="add-button-container">
      <button onclick="location.href='/AOARegistroActor.php'" class="add-movie-btn">
        Registrar Actor
      </button>
    </div>
    <?php if ($has_items) { ?>
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
          <?php foreach ($actores as $actor) { ?>
            <tr>
              <td><?php echo $actor['id_actor'] ?></td>
              <td><?php echo $actor['nombre'] . ' ' . $actor['ap_paterno'] . ' ' . $actor['ap_materno'] ?></td>

              <td><?php echo $actor['nacionalidad'] ?></td>
              <td><?php echo $actor['fecha_nacimiento'] ?></td>
              <td>
                <a href="/AOARegistroActor.php?id=<?php echo $actor['id_actor'] ?>">Editar</a>
                <a href="/AOAEliminarActor.php?id=<?php echo $actor['id_actor'] ?>">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>No hay actores registrados</p>
    <?php } ?>

  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>