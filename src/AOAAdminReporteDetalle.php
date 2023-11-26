<?php
include_once('./db.php');
session_start();

$db = new Database();

$id = $_GET['id'];

$cliente = $db->row("SELECT * FROM tblcliente WHERE id_cliente = $id");

$nombre_cliente = $cliente['nombre'] . ' ' . $cliente['ap_paterno'] . ' ' . $cliente['ap_materno'];

$peliculas = $db->array("SELECT * FROM tbl_pelicula");

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title><?php echo $nombre_cliente; ?> -
        PelisNow</title>
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

        <h1>Películas visualizadas por el suscriptor: <b><?php echo $nombre_cliente ?></b></h1>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Película
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($peliculas as $peliculas) { ?>

                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $peliculas['id_pelicula'] ?>
                            </th>
                            <td class="px-6 py-4">
                                <?php echo $peliculas['nombre'] ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="./AOAAdminReporteDetallePelicula.php?cliente=<? echo $cliente['id_cliente'] ?>&pelicula=<?php echo $peliculas['id_pelicula'] ?>" class="bg-blue-500 text-white p-2 rounded">Ver detalle</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>