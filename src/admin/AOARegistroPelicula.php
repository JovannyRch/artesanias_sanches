<?php
include_once('./validators.php');
session_start();

$categorias = [
  [
    'id' => "animacion",
    'nombre' => 'Animación'
  ],
  [
    'id' => "accion",
    'nombre' => 'Acción'
  ],
  [
    'id' => "comedia",
    'nombre' => 'Comedia'
  ]
];

$anio_lanzamiento = "";
$nombre = "";
$pais = "";
$sinopsis = "";
$categoria = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $nombre = $_POST['title'];
    $sinopsis = $_POST['synopsis'];
    $anio_lanzamiento = $_POST['year'];
    $categoria = $_POST['category'];


    if (isset($_POST['title']) && strlen($_POST['title']) > 0) {

      $validation = isOnlyCharacters($nombre);
      if (!$validation) {
        throw new Exception("El nombre solo puede contener letras");
      }
    } else {
      throw new Exception("El nombre es requerido");
    }


    if (isset($_POST['synopsis']) && strlen($_POST['synopsis']) > 0) {

      $validation = isOnlyCharacters($sinopsis);
      if (!$validation) {
        throw new Exception("La sinopsis solo puede contener letras");
      }
    } else {
      throw new Exception("La sinopsis es requerida");
    }

    if (isset($_POST['year']) && strlen($_POST['year']) > 0) {


      $error_message = isValidYear($anio_lanzamiento);
      if (strlen($error_message)  > 0) {
        throw new Exception($error_message);
      }
    } else {
      throw new Exception("El año de lanzamiento es requerido");
    }


    if (isset($_POST['category'])) {
      $validation = isOnlyCharacters($categoria);
      if (!$validation) {
        throw new Exception("La categoría solo puede contener letras");
      }
    } else {
      throw new Exception("La categoría es requerida");
    }
    $_SESSION['success_message'] = "Registro exitoso";
  } catch (\Throwable $th) {
    $_SESSION['message'] = $th->getMessage();
  }
}



?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Registro película - PelisNow</title>
  <link rel="stylesheet" href="../styles.css" />
</head>

<body>
  <header>
    <nav class="navbar">
      <div class="navbar-brand">PelisNow</div>
      <div class="navbar-nav">
        <a href="../AOAAdminInicio.php" class="nav-item">Inicio</a>
        <a href="../AOAAdminPeliculas.php" class="nav-item">Películas</a>
        <a href="../AOAAdminCategorias.php" class="nav-item">Categorías</a>
        <a href="../AOAAdminDirectores.php" class="nav-item">Directores</a>
        <a href="../AOAAdminActores.php" class="nav-item">Actores</a>
        <a href="../AOALogin.php" class="nav-item">Logout</a>
      </div>
    </nav>
  </header>
  <div class="form-container">
    <h1>Registro de película</h1>
    <form class="login-form" method="POST" action="./AOARegistroPelicula.php">
      <label for="title">Nombre de la película:</label>
      <input type="text" id="title" name="title" value="<?= $nombre ?>" />
      <br />
      <label for="director">Director:</label>
      <select id="director" name="director">
        <option value="1">Hayao Miyazaki</option>
        <option value="2">Chava Cartas</option>
        <option value="3">Nia DaCosta</option>
        <option value="3">Cal Brunker</option>
      </select>
      <br />

      <label for="actor1">Actor 1:</label>
      <select id="actor1" name="actor1">
        <option value="1">Rumi Hiiragi</option>
        <option value="2">Memo Villegas</option>
        <option value="3">Brie Larson</option>
        <option value="4">Kim Kardashian</option>
      </select>
      <br />

      <label for="actor2">Actor 2:</label>
      <select id="actor2" name="actor2">
        <option value="1">Jason Marsden</option>
        <option value="2">Verónica Bravo</option>
        <option value="3">Isman Vellani</option>
        <option value="4">Ron Pardo</option>
      </select>
      <br />

      <!-- PAis -->
      <label for="country">País:</label>
      <select id="country" name="country">
        <option value="1">Japón</option>
        <option value="2">Estados Unidos</option>
        <option value="3">México</option>
      </select>
      <br />

      <!-- Sinopsis -->
      <label for="synopsis">Sinopsis:</label>
      <textarea id="synopsis" name="synopsis"><?= $sinopsis ?></textarea>
      <br />

      <!-- Anio de lanzamiento -->
      <label for="year">Año de lanzamiento:</label>
      <input type="text" id="year" name="year" value="<?= $anio_lanzamiento ?>" />
      <br />

      <!-- Categoria -->
      <label for=" category">Categoría:</label>
      <select id="category" name="category" required>
        <option value="">Seleccione una categoría</option>
        <?php foreach ($categorias as $item) { ?>
          <option value="<?= $item['id'] ?>" <?= "$categoria" ==  $item['id'] ? "selected" : "" ?>><?= $item['nombre'] ?></option>
        <?php } ?>
      </select>

      <label for="image">Imagen:</label>
      <input type="file" id="image" name="image" accept="image/png, image/jpeg" />

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