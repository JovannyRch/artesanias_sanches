<?php
include_once('./db.php');
session_start();

$db = new Database();

$id = $_GET['id'];

$cliente = $db->row("SELECT * FROM tblcliente WHERE id_cliente = $id");

if (!$cliente) {
    header('Location: ./AOAAdminInicio.php');
}


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
        <div>
            <h1>Eliminar cliente</h1>
            <p>¿Estás seguro de que deseas eliminar el cliente <strong><?php echo $cliente['nombre'] ?></strong>?</p>
            <form action="./aoa_eliminar_cliente.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente'] ?>">
                <input type="submit" value="Eliminar" class="bg-red-500 text-white rounded p-4 cursor-pointer">
            </form>

        </div>
    </div>

</body>

</html>