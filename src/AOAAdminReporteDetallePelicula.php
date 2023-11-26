<?php
include_once('./db.php');
session_start();

$db = new Database();

$cliente_id = $_GET['cliente'];
$pelicula_id = $_GET['pelicula'];



$cliente = $db->row("SELECT * FROM tblcliente WHERE id_cliente = $cliente_id");

$nombre_cliente = $cliente['nombre'] . ' ' . $cliente['ap_paterno'] . ' ' . $cliente['ap_materno'];

$pelicula = $db->row("SELECT * FROM tbl_pelicula WHERE id_pelicula = $pelicula_id");

$pelicula['director'] = $db->row("SELECT * FROM tbldirector WHERE id_director = " . $pelicula['id_director']);
$pelicula['actor1'] = $db->row("SELECT * FROM tblactor WHERE id_actor = " . $pelicula['id_actor1']);
$pelicula['actor2'] = $db->row("SELECT * FROM tblactor WHERE id_actor = " . $pelicula['id_actor2']);

$categoria = $db->row("SELECT * FROM tblcategoria WHERE id_categoria = " . $pelicula['id_categoria']);
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

        <h1>
            Película vista por el suscriptor: <b><?php echo $nombre_cliente ?></b></h1>
        <h1>
            Información de la película: <b><?php echo $pelicula['nombre'] ?></b>
        </h1>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Concepto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Desripción
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <!-- titulo -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4">
                            Título
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $pelicula['nombre'] ?>
                        </td>
                    </tr>

                    <!-- Categoria y clasificacion -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4">
                            Categoría
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $categoria['nombre'] ?>
                        </td>
                    </tr>
                    <!-- Pais y año de lanzamiento -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4">
                            País
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $pelicula['pais'] ?>
                        </td>
                    </tr>

                    <!-- Sinopsis -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4">
                            Sinopsis
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $pelicula['sinopsis'] ?>
                        </td>
                    </tr>
                    <!-- Pais -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4">
                            Año de lanzamiento
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $pelicula['anio_lanzamiento'] ?>
                        </td>
                    </tr>
                    <!-- Director -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4">
                            Director
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $pelicula['director']['nombre'] . ' ' . $pelicula['director']['ap_paterno'] . ' ' . $pelicula['director']['ap_materno']
                            ?>
                        </td>
                    </tr>
                    <!-- Actores -->
                    <tr class="bg-gray-50 dark:bg-gray-700">
                        <td class="px-6 py-4">
                            Actores
                        </td>
                        <td class="px-6 py-4">
                            <?php echo $pelicula['actor1']['nombre'] . ' ' . $pelicula['actor1']['ap_paterno'] . ' ' . $pelicula['actor1']['ap_materno'] ?>
                            <br>
                            <?php echo $pelicula['actor2']['nombre'] . ' ' . $pelicula['actor2']['ap_paterno'] . ' ' . $pelicula['actor2']['ap_materno'] ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>