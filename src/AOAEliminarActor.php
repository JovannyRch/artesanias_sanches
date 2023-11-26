<?php
include_once('./db.php');
include_once('./aoa_eliminar_actor.php');
include_once('./aoa_validar_eliminacion_actor.php');
session_start();

$db = new Database();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id_actor'];
    eliminarActor($db, $id);
    header("Location: ./AOAAdminActores.php");
}


$id = $_GET['id'];
$error_message = "";

if (!validarEliminacionActor($db, $id)) {
    $error_message = "No se puede eliminar el actor porque tiene películas asociadas";
}

$actor =  $db->row("SELECT * FROM tblactor WHERE id_actor = $id");

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

        <?php if ($error_message) { ?>
            <div class="alert alert-danger">
                <?php echo $error_message ?>
            </div>
        <?php } else { ?>
            <p>¿Está seguro que desea eliminar el actor <b><?php echo $actor['nombre'] . " " . $actor['ap_paterno'] . " " . $actor['ap_materno'] ?></b>?</p>

            <form method="POST" action="./AOAEliminarActor.php">
                <input type="hidden" name="id_actor" value="<?php echo $actor['id_actor'] ?>" />
                <button type="submit" class="bg-red-500 text-white mt-5 p-4">Eliminar</button>
            </form>
        <?php } ?>



    </div>

</body>

</html>