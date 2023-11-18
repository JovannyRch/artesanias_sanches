<?php
session_start();

// Verificar si el usuario no ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if (isset($title)) {
            echo $title . " - SIMAQ";
        } else {
            echo "SIMAQ";
        } ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="path_to_tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <header class="bg-blue-600 text-white">
        <div class="container mx-auto p-4">
            <h1 class="flex items-center gap-4">

                <img src="./assets/logo.png" alt="Imagen de ejemplo" class="inline-block h-8">
                Sistema de Nómina

                <!-- Logo -->

            </h1>
            <!-- Aquí puedes incluir más elementos en tu encabezado -->
        </div>
    </header>
    <?php if (!(isset($hideNavbar) && ($hideNavbar == true))) { ?>

        <nav class="bg-red-600 text-white">
            <div class="container mx-auto p-4">
                <ul class="flex space-x-4">
                    <li><a href="dashboard.php" class="hover:text-gray-200">Dashboard</a></li>
                    <li><a href="empleados.php" class="hover:text-gray-200">Gestión de Empleados</a></li>
                    <li><a href="nomina.php" class="hover:text-gray-200">Cálculo de Nómina</a></li>
                    <li><a href="reportes.php" class="hover:text-gray-200">Reportes</a></li>



                    <li class="flex-1 text-right">
                        <!-- Logout -->
                        <form action="logout.php" method="POST">
                            <button type="submit" class="hover:text-gray-200">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    <?php } ?>


    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 flex-1">
        <?php
        // Aquí se incluirá el contenido específico de cada página
        if (isset($content)) {
            echo $content;
        }
        ?>
    </main>

    <!-- Pie de Página -->
    <footer class="bg-blue-600 text-white mt-8">
        <div class="container mx-auto p-4">
            <p>&copy; <?php echo date("Y"); ?> SIMAQ - Todos los derechos reservados</p>
            <!-- Más información de pie de página si es necesario -->
        </div>
    </footer>

</body>

</html>