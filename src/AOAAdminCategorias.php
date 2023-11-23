<?php


session_start();

include_once('./db.php');
include_once('./aoa_leer_categorias.php');

$db = new Database();

$categorias =  leerCategorias($db);

$hasItems = count($categorias) > 0;

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Categorías - PelisNow Admin</title>
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
    <h1>Listado de categorías</h1>
    <div class="add-button-container">
      <button onclick="location.href='/AOARegistroCategoria.php'" class="add-movie-btn">
        Registrar Categoría
      </button>
    </div>
    <?php if ($hasItems) { ?>
      <table class="movies-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categorias as $categoria) { ?>
            <tr>
              <td><?php echo $categoria['id_categoria'] ?></td>
              <td><?php echo $categoria['nombre'] ?></td>
              <td>
                <a href="/AOARegistroCategoria.php?id=<?php echo $categoria['id_categoria'] ?>">Editar</a>
                <a href="/AOAEliminarCategoria.php?id=<?php echo $categoria['id_categoria'] ?>">Eliminar</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php } else { ?>
      <p>No hay categorías registradas</p>
    <?php } ?>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>