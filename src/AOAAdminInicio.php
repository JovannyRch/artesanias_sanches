<?
include_once('./db.php');
include_once('./aoa_leer_clientes.php');

session_start();
$db = new Database();

$clientes = leerClientes($db);

?>
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
      <a href="/AOARegistroCliente.php" class="add-movie-btn">
        Registrar Nuevo Cliente
      </a>
    </div>

    <?php if (count($clientes) == 0) { ?>
      <div class="empty-movies-container">
        <p>No hay clientes registrados</p>
      </div>
    <?php } ?>


    <table class="movies-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Curp</th>
          <th>Membresía</th>
          <th>Fecha de registro</th>
          <th>
            Acciones
          </th>
        </tr>
      </thead>
      <tbody>

        <?php foreach ($clientes as $cliente) { ?>
          <tr>
            <td><?php echo $cliente['id_cliente'] ?></td>
            <td><?php echo $cliente['nombre'] . " " . $cliente['ap_paterno'] . " " . $cliente['ap_materno'] ?></td>
            <td><?php echo $cliente['curp'] ?></td>
            <td><?php echo $cliente['tipo_membresia'] ?></td>
            <td><?php echo $cliente['fecha_inicio_membresia'] ?></td>
            <td>
              <a href="/AOARegistroCliente.php?id=<?php echo $cliente['id_cliente'] ?>" class="edit-movie-btn">
                Editar
              </a>
              <a href="/AOAEliminarCliente.php?id=<?php echo $cliente['id_cliente'] ?>" class="delete-movie-btn">
                Eliminar
              </a>
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