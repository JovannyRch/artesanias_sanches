<?php
include_once('./db.php');
include_once('./aoa_eliminar_pelicula.php');
session_start();

$db = new Database();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id_pelicula'];
    eliminarPelicula($db, $id);
    header("Location: ./AOAAdminPeliculas.php");
}



$id = $_GET['id'];

$pelicula = $db->row("SELECT * FROM tbl_pelicula WHERE id_pelicula = $id");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>PelisNow</title>
    <link rel="stylesheet" href="./../styles.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="movies-container">
        <p>
            ¿Está seguro que desea eliminar la película <b><?php echo $pelicula['nombre'] ?></b>?
        </p>

        <form method="POST" action="./AOAEliminarPelicula.php">
            <input type="hidden" name="id_pelicula" value="<?php echo $pelicula['id_pelicula'] ?>" />
            <button type="submit" class="bg-red-500 text-white mt-5 p-4">Eliminar</button>
        </form>

    </div>

</body>

</html>