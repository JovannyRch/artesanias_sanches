<?php
include_once('./validators.php');
session_start();

$nombre = "";
$paterno = "";
$materno = "";
$fecha = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {

    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $fecha = $_POST['fecha'];


    if (isset($_POST['nombre']) && strlen($_POST['nombre']) > 0) {

      $validation = isOnlyCharacters($nombre);
      if (!$validation) {
        throw new Exception("El nombre solo puede contener letras");
      }
    } else {
      throw new Exception("El nombre es requerido");
    }

    if (isset($_POST['paterno']) && strlen($_POST['paterno']) > 0) {

      $validation = isOnlyCharacters($paterno);
      if (!$validation) {
        throw new Exception("El apellido paterno solo puede contener letras");
      }
    } else {
      throw new Exception("El apellido paterno es requerido");
    }

    if (isset($_POST['materno']) && strlen($_POST['materno']) > 0) {

      $validation = isOnlyCharacters($materno);
      if (!$validation) {
        throw new Exception("El apellido materno solo puede contener letras");
      }
    } else {
      throw new Exception("El apellido materno es requerido");
    }


    if (isset($_POST['fecha']) && strlen($_POST['fecha']) > 0) {

      $validation = isValidBirthDate($fecha);
      if (!$validation) {
        throw new Exception("La fecha de nacimiento no es válida, formatos válidos: AAA-MM-DD o DD/MM/AAA");
      }
    } else {
      throw new Exception("La fecha de nacimiento es requerida");
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
  <title>Registro director - PelisNow</title>
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
    <h1>Registro de director</h1>
    <form class="login-form" method="POST" action="./AOARegistroDirector.php">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>" required />

      <label for="paterno">A. Paterno:</label>
      <input type="text" id="paterno" name="paterno" value="<?= $paterno ?>" required />

      <label for="materno">A. Materno:</label>
      <input type="text" id="materno" name="materno" value="<?= $materno ?>" required />

      <label for="country">País de nacimiento:</label>
      <select id="country" name="country" required>
        <option value="japon">Japón</option>
        <option value="usa">Estados Unidos</option>
        <option value="mexico">México</option>
      </select>

      <label for="fecha">Fecha de nacimiento:</label>
      <input type="text" id="fecha" name="fecha" value="<?= $fecha ?>" required placeholder="AAAA-MM-DD o DD/MM/AAAA" />
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
      <br />
      <br />
      <button type="submit">Guardar</button>
    </form>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>