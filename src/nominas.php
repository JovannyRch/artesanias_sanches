<?php
include_once './const.php';
include_once './db.php';


session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$title = "Nóminas";
$db = new Database();

$nominas = $db->getNominas();

$total = count($nominas);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title ?> - SIMAQ
    </title>
    <script src="./assets/tailwind.js"></script>
    <script src="./assets/chart.js"></script>
    <script src="./assets/vue.js"></script>
    <script src="./assets/axios.js"></script>
    <link rel="stylesheet" href="./assets/flowbite.css">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen dark:bg-gray-900 antialiased">

    <header class="sticky top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-800">
        <div class="flex items-center justify-between w-full px-3 py-3 mx-auto max-w-8xl lg:px-4">
            <div class="flex items-center">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 mr-2 text-gray-500 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="flex items-center justify-between">

                    <a href="/" class="flex">
                        <img src="./assets/logo.png" alt="Imagen de ejemplo" class="inline-block h-8">
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white ml-4">
                            SIMAQ
                        </span>
                    </a>
                </div>

            </div>

            <div class="flex items-center">
                <ul id="flowbiteMenu" class="flex-col hidden pt-6 lg:flex-row lg:self-center lg:py-0 lg:flex">


                    <?php foreach ($menu as $item) { ?>
                        <li class="mb-3 lg:px-2 xl:px-2 lg:mb-0">
                            <a href="<?php echo $item['url']; ?>" class="text-sm font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500"><?php echo $item['title']; ?></a>
                        </li>
                    <?php } ?>

                </ul>

                <a href="./logout.php" class="hidden xl:inline-flex items-center text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-1 sm:ml-3">
                    Cerrar sesión
                </a>
            </div>
        </div>

    </header>



    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 flex-1" id="app">

        <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">
            <?php echo $title ?>
        </h1>

        <?php if ($total == 0) { ?>
            <div class="flex flex-col items-center justify-center h-[400px]">
                <h2 class="text-2xl font-bold text-gray-600">No hay registrados</h2>
            </div>

        <?php } else { ?>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                ID
                            </th>

                            <!-- Empleado -->
                            <th scope="col" class="px-6 py-3">
                                Empleado
                            </th>

                            <!-- Periodo -->
                            <th scope="col" class="px-6 py-3">
                                Periodo
                            </th>

                            <!-- dias_de_pago -->
                            <th scope="col" class="px-6 py-3">
                                Días de pago
                            </th>

                            <!-- Fecha -->
                            <th scope="col" class="px-6 py-3">
                                Fecha procesamiento
                            </th>

                            <!-- Sueldo bruto -->
                            <th scope="col" class="px-6 py-3">
                                Sueldo bruto
                            </th>



                            <!-- Sueldo neto -->
                            <th scope="col" class="px-6 py-3">
                                Sueldo neto
                            </th>


                            <th scope="col" class="px-6 py-3">
                                Acciones
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($nominas as $item) { ?>

                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $item['id']; ?>
                                </th>

                                <!-- Empleado -->
                                <td class="px-6 py-4">
                                    <?php echo $item['empleado']['nombre'] . " " . $item['empleado']['paterno'] . " " . $item['empleado']['materno']; ?>

                                </td>

                                <!-- Periodo -->
                                <td class="px-6 py-4">
                                    <?php echo formatDate($item['periodo_inicio']) . " - " . formatDate($item['periodo_fin']); ?>
                                </td>

                                <!-- Días -->
                                <td class="px-6 py-4">
                                    <?php echo $item['dias_de_pago']; ?>
                                </td>

                                <!-- Fecha -->
                                <td class="px-6 py-4">
                                    <?php echo formatDate($item['fecha_procesamiento']); ?>
                                </td>

                                <!-- Sueldo bruto -->
                                <td class="px-6 py-4">
                                    <?php echo formatCurrency($item['salario_bruto']); ?>
                                </td>

                                <!-- Sueldo neto -->

                                <td class="px-6 py-4">
                                    <?php echo formatCurrency($item['salario_neto']); ?>
                                </td>



                                <td class="px-6 py-4">
                                    <a href="./detalles_nomina.php?id=<?php echo $item['id'] ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Detalles</a>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        <?php } ?>
    </main>

    <!-- Pie de Página -->
    <footer class="bg-blue-600 text-white mt-8 w-screen">
        <div class="container mx-auto p-4 text-center">
            <p>&copy; <?php echo date("Y"); ?> SIMAQ - Todos los derechos reservados</p>
        </div>
    </footer>
    <script>
        const config = {
            headers: {
                "Content-Type": "multipart/form-data"
            }
        };

        const formatCurrency = new Intl.NumberFormat('es-MX', {
            style: 'currency',
            currency: 'MXN',
            minimumFractionDigits: 0
        })

        const app = new Vue({
            el: '#app',
            data: {

            },
            methods: {

            },
            created: function() {

            },
        });
    </script>
    <script src="./assets/flowbite.css"></script>

</body>

</html>