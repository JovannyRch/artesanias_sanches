<?php
include_once('./db.php');
include_once('./aoa_eliminar_categoria.php');

session_start();

$db = new Database();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    eliminarCategoria($db, $id);
    header("Location: ./AOAAdminCategorias.php");
}

$id =  $_GET['id'];
$categoria = $db->row("SELECT * FROM tblcategoria WHERE id_categoria = $id");


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
        <p>¿Está seguro que desea eliminar la categoría <b><?php echo $categoria['nombre'] ?></b>?</p>

        <form method="POST" action="./AOAEliminarCategoria.php">
            <input type="hidden" name="id" value="<?php echo $categoria['id_categoria'] ?>" />
            <button type="submit" class="bg-red-500 text-white mt-5 p-4">Eliminar</button>
        </form>

    </div>

</body>

</html>