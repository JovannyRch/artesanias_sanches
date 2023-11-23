<?php
include_once('./validators.php');
include_once('./db.php');
include_once('./aoa_crear_pelicula.php');
include_once('./aoa_editar_pelicula.php');
session_start();


$db = new Database();


function getBase64Image($image)
{
  $type = pathinfo($image, PATHINFO_EXTENSION);
  $data = file_get_contents($image);
  $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
  return $base64;
}

$countries = [
  [
    'id' => 'japon',
    'name' => 'Japón'
  ],
  [
    'id' => 'mexico',
    'name' => 'México'
  ],
  [
    'id' => 'usa',
    'name' => 'Estados Unidos'
  ]
];

$categorias = $db->array("SELECT * FROM tblcategoria");
$actores = $db->array("SELECT * FROM tblactor");
$directores = $db->array("SELECT * FROM tbldirector");

$anio_lanzamiento = "";
$nombre = "";
$pais = "";
$sinopsis = "";
$categoria = "";
$actor1 = "";
$actor2 = "";
$imagen = "";
$director = "";
$clasificacion = "";



$is_edit = isset($_GET['id']);
$id = null;

if ($is_edit) {
  $id = $_GET['id'];
  $pelicula = $db->row("SELECT * FROM tbl_pelicula WHERE id_pelicula = $id");

  $nombre = $pelicula['nombre'];
  $anio_lanzamiento = $pelicula['anio_lanzamiento'];
  $sinopsis = $pelicula['sinopsis'];
  $categoria = $pelicula['id_categoria'];
  $actor1 = $pelicula['id_actor1'];
  $actor2 = $pelicula['id_actor2'];
  $imagen = $pelicula['imagen'];
  $clasificacion  = $pelicula['clasificacion'];
  $pais = $pelicula['pais'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $nombre = $_POST['title'];
    $sinopsis = $_POST['synopsis'];
    $anio_lanzamiento = $_POST['year'];
    $categoria = $_POST['category'];
    $actor1 = $_POST['actor1'];
    $actor2 = $_POST['actor2'];
    $imagen = $_POST['image'];
    $director = $_POST['director'];
    $clasificacion = $_POST['clasificacion'];
    $pais = $_POST['country'];



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


    if (!isset($_POST['category'])) {
      throw new Exception("La categoría es requerida");
    }

    if (isset($_POST['id_pelicula'])) {
      $id_pelicula = $_POST['id_pelicula'];

      editarPelicula($db, $id_pelicula, $categoria, $actor1, $actor2, $nombre, $pais, $sinopsis, $anio_lanzamiento, $clasificacion, $imagen, $director);
    } else {
      crearPelicula($db, $categoria, $actor1, $actor2, $nombre, $pais, $sinopsis, $anio_lanzamiento, $clasificacion, $imagen, $director);
    }

    header("Location: ./AOAAdminPeliculas.php");


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


      <?php if ($is_edit) { ?>
        <input type="hidden" name="id_pelicula" value="<?= $id ?>" />
      <?php } ?>

      <label for="title">Nombre de la película:</label>
      <input type="text" id="title" name="title" value="<?= $nombre ?>" />
      <br />
      <label for="director">Director:</label>
      <select id="director" name="director">
        <?php foreach ($directores as $item) { ?>
          <option value="<?= $item['id_director'] ?>"><?= $item['nombre'] ?></option>
        <?php } ?>
      </select>
      <br />

      <label for="actor1">Actor 1:</label>
      <select id="actor1" name="actor1">
        <?php foreach ($actores as $item) { ?>
          <option value="<?= $item['id_actor'] ?>" <?= $item['id_actor'] === $actor1 ? 'selected' : '' ?>><?= $item['nombre'] ?></option>
        <?php } ?>

      </select>
      <br />

      <label for="actor2">Actor 2:</label>
      <select id="actor2" name="actor2">
        < <?php foreach ($actores as $item) { ?> <option value="<?= $item['id_actor'] ?>" <?= $item['id_actor'] === $actor2 ? 'selected' : '' ?>><?= $item['nombre'] ?></option>
        <?php } ?>
      </select>
      <br />

      <!-- PAis -->
      <label for="country">País:</label>
      <select id="country" name="country">
        <option value="japon">Japón</option>
        <option value="usa">Estados Unidos</option>
        <option value="mexico">México</option>
      </select>
      <br />

      <!-- Clasificacion -->
      <label for="clasificacion">Clasificación:</label>
      <select id="clasificacion" name="clasificacion">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="B15">B15</option>
        <option value="C">C</option>
        <option value="D">D</option>
      </select>

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
          <option value="<?= $item['id_categoria'] ?>" <?= $categoria ==  $item['id_categoria'] ? "selected" : "" ?>><?= $item['nombre'] ?></option>
        <?php } ?>
      </select>

      <label for="image">URL de la imagen:</label>
      <input type="text" id="image" name="image" value="<?php echo $imagen ?>" />

      <?php if ($imagen) { ?>
        <img src="<?php echo $imagen ?>" alt="" />
      <?php } ?>

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