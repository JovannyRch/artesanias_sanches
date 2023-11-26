<?php
include_once('./db.php');
include_once('./aoa_eliminar_director.php');
session_start();


$db = new Database();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id_director'];
    eliminarDirector($db, $id);
    header("Location: ./AOAAdminDirectores.php");
}

$id = $_GET['id'];

$director = $db->row("SELECT * FROM tbldirector WHERE id_director = $id");
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
                <a href="./../AOAAdminReportes.php" class="nav-item">Reportes</a>
                <a href="../AOAAdminPeliculas.php" class="nav-item">Películas</a>
                <a href="../AOAAdminCategorias.php" class="nav-item">Categorías</a>
                <a href="../AOAAdminDirectores.php" class="nav-item">Directores</a>
                <a href="../AOAAdminActores.php" class="nav-item">Actores</a>
                <a href="../AOALogin.php" class="nav-item">Logout</a>
            </div>
        </nav>
    </header>
    <div class="movies-container">
        <p>¿Está seguro que desea eliminar la película <b><?php echo $director['nombre'] . " " . $director['ap_paterno'] . " " . $director['ap_materno'] ?></b>?</p>

        <form method="POST" action="./AOAEliminarDirector.php">
            <input type="hidden" name="id_director" value="<?php echo $director['id_director'] ?>" />
            <button type="submit" class="bg-red-500 text-white mt-5 p-4">Eliminar</button>
        </form>
    </div>

</body>

</html>