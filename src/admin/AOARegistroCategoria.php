<?php
include_once('./validators.php');
session_start();

$categoria = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $categoria = $_POST['nombre'];

    if (isset($_POST['nombre']) && strlen($_POST['nombre']) > 0) {

      $validation = isOnlyCharacters($categoria);
      if (!$validation) {
        throw new Exception("El nombre solo puede contener letras");
      }
    } else {
      throw new Exception("El nombre es requerido");
    }
    $_SESSION['success_message'] = "Registro exitoso";
  } catch (Exception $e) {
    $_SESSION['message'] = $e->getMessage();
  }
}


?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Registro categoría - PelisNow</title>
  <link rel="stylesheet" href="./../styles.css" />
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="navbar-brand">PelisNow</div>
      <div class="navbar-nav">
        <a href="./../AOAAdminInicio.php" class="nav-item">Inicio</a>
        <a href="../AOAAdminPeliculas.php" class="nav-item">Películas</a>
        <a href="../AOAAdminCategorias.php" class="nav-item">Categorías</a>
        <a href="../AOAAdminDirectores.php" class="nav-item">Directores</a>
        <a href="../AOAAdminActores.php" class="nav-item">Actores</a>
        <a href="../AOALogin.php" class="nav-item">Logout</a>
      </div>
    </nav>
  </header>
  <div class="form-container">
    <h1>Registro de categoría</h1>
    <form class="login-form" method="POST" action="./AOARegistroCategoria.php">
      <label for="nombre">Nombre de la categoría:</label>
      <input type="text" id="nombre" name="nombre" value="<?= $categoria ?>" />

      <br />
      <br />

      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert">
          <p> Error: <?php echo $_SESSION['message']; ?></p>
        </div>
      <?php
        unset($_SESSION['message']);
      } ?>

      <?php if (isset($_SESSION['success_message'])) { ?>
        <div class="success">
          <p> <?php echo $_SESSION['success_message']; ?></p>
        </div>
      <?php
        unset($_SESSION['success_message']);
      } ?>

      <button type="submit">Guardar</button>
    </form>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

<script>
  function onSubmit(token) {
    window.location.href = "AOAInicio.php";
  }
</script>

</html>