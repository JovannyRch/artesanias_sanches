<?php
include_once './const.php';
include_once './db.php';


session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$title = "Detalles nómina";
$db = new Database();


$id = $_GET['id'];

$nomina = $db->getCalculoNomina($id);

$datos_empleado = $nomina['empleado'];
$empleado = $datos_empleado['nombre'] . " " . $datos_empleado['paterno'] . " " . $datos_empleado['materno'];

$anio_registro = date("Y", strtotime($nomina['fecha_procesamiento']));

$periodo_inicio = date("Y-m-d", strtotime($nomina['periodo_inicio']));
$periodo_fin = date("Y-m-d", strtotime($nomina['periodo_fin']));

$subtotal = $nomina['salario_bruto'] + $nomina['total_asignaciones'];

$asignaciones = json_decode($nomina['asignaciones'], true);
$deducciones = json_decode($nomina['deducciones'], true);


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

        <div class="flex justify-center flex-col items-center">

            <div class="w-full max-w-lg p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700 mt-5">
                <h5 class="mb-3 text-base font-semibold text-gray-900 md:text-xl dark:text-white">
                    <?php echo $datos_empleado['id'] ?> - <?php echo $empleado ?>
                </h5>
                <div class="text-sm font-normal text-gray-700 dark:text-gray-400">
                    <div class="grid grid-cols-2">
                        <div>
                            RFC:
                        </div>
                        <div>
                            <?php echo $datos_empleado['rfc'] ?>
                        </div>
                        <div>
                            CURP:
                        </div>
                        <div>
                            <?php echo $datos_empleado['curp'] ?>
                        </div>
                        <div>
                            Puesto:
                        </div>
                        <div>
                            <?php echo $datos_empleado['cargo'] ?>
                        </div>

                        <div>

                            Inicio periodo:
                        </div>
                        <div>
                            <?php echo $periodo_inicio ?>
                        </div>

                        <div>
                            Fin periodo:
                        </div>
                        <div>
                            <?php echo $periodo_fin ?>
                        </div>

                        <div>
                            Días de Pago:
                        </div>
                        <div>
                            <?php echo $nomina['dias_de_pago'] ?>
                        </div>

                    </div>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Asignaciones
                        </caption>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Cocepto
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cantidad
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($asignaciones as $item) { ?>
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $item['concepto']; ?>
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo formatCurrency($item['valor']); ?>
                                    </th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-5 mt-5">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Deducciones
                        </caption>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Cocepto
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Cantidad
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($deducciones as $item) { ?>
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $item['concepto']; ?>
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo formatCurrency($item['valor']); ?>
                                    </th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

                <!-- Deducciones table -->


                <div class="h-[20px]"></div>

                <ul class="my-4 space-y-3 mt-5">
                    <li>
                        <div class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50  group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <div></div>
                            <div class="flex-1 ms-3 whitespace-nowrap flex justify-between">
                                <div>
                                    Sueldo bruto
                                </div>
                                <div>
                                    <?php echo formatCurrency($nomina['salario_bruto']) ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50  group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <div></div>
                            <div class="flex-1 ms-3 whitespace-nowrap flex justify-between">
                                <div>
                                    Percepciones
                                </div>
                                <div>
                                    <?php echo formatCurrency($nomina['total_asignaciones']) ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50  group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <div></div>
                            <div class="flex-1 ms-3 whitespace-nowrap flex justify-between">
                                <div>
                                    Deducciones
                                </div>
                                <div>
                                    <?php echo formatCurrency($nomina['total_deducciones']) ?>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center p-3 text-base font-bold text-blue-600  rounded-lg bg-gray-50  group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                            <div></div>
                            <div class="flex-1 ms-3 whitespace-nowrap flex justify-between">
                                <div>
                                    Sueldo neto
                                </div>
                                <div>
                                    <?php echo formatCurrency($nomina['salario_neto']) ?>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="flex justify-end mt-5 w-full max-w-lg">
                <a href="./reporte_nomina.php?id=<?php echo $id ?>" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-blue-500">
                    Descargar PDF
                </a>
            </div>
        </div>
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