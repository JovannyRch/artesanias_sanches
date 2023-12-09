<?php
include_once './const.php';
include_once './db.php';
session_start();


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$title = "Dashboard";
$db = new Database();

$total_empleados = $db->row("SELECT COUNT(*) total FROM empleados")['total'];
$total_departamentos = $db->row("SELECT COUNT(*) total FROM departamentos")['total'];
$total_cargos = $db->row("SELECT COUNT(*) total FROM cargos")['total'];

$cantidad_empelados_por_departamento = $db->array("SELECT d.nombre, COUNT(*) cantidad FROM empleados e INNER JOIN departamentos d ON e.departamento_id = d.id GROUP BY d.id");

$departamentos = $db->array("SELECT * FROM departamentos");

$empleados_por_departamento = array();
foreach ($departamentos as $departamento) {
    $empleados_por_departamento[$departamento['nombre']] = $db->array("SELECT empleados.*, cargos.nombre as cargo FROM empleados
    INNER JOIN cargos ON empleados.cargo_id = cargos.id
    WHERE departamento_id = " . $departamento['id']);
}



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title ?> - SIMAQ
    </title>
    <script src="./assets/vue.js"></script>
    <script src="./assets//tailwind.js"></script>
    <script src="./assets/chart.js"></script>
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
    <main class="container mx-auto p-4 flex-1">

        <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">
            <?php echo $title ?>
        </h1>


        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

            <div class=" p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                <dl class="grid max-w-screen-xl grid-cols-2 gap-8 p-4 mx-auto text-gray-900 sm:grid-cols-3 xl:grid-cols-3 dark:text-white sm:p-8">
                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">
                            <?php echo $total_empleados; ?>
                        </dt>
                        <dd class="text-gray-500 dark:text-gray-400">
                            Empleados
                        </dd>
                    </div>


                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">
                            <?php echo $total_departamentos; ?>
                        </dt>
                        <dd class="text-gray-500 dark:text-gray-400">
                            Departamentos
                        </dd>
                    </div>

                    <div class="flex flex-col items-center justify-center">
                        <dt class="mb-2 text-3xl font-extrabold">
                            <?php echo $total_cargos; ?>
                        </dt>
                        <dd class="text-gray-500 dark:text-gray-400">
                            Cargos
                        </dd>
                    </div>
                </dl>
            </div>

            <dd class="text-gray-500 dark:text-gray-400  p-8 text-2xl font-bold">
                Empleados por departamento

                <!-- Add chart -->
                <div class="flex flex-col items-center justify-center h-[400px] w-full">
                    <canvas id="myChart"></canvas>
                </div>

                <div class="grid grid-cols-1 gap-4  p-4 mx-auto text-gray-900 sm:grid-cols-2 xl:grid-cols-3 dark:text-white sm:p-8">
                    <?php foreach ($empleados_por_departamento as $departamento => $empleados) { ?>
                        <div class="flex flex-col items-center justify-start w-full  py-8">
                            <h2 class="text-lg font-bold"><?php echo $departamento; ?></h2>

                            <div class="h-[400px] overflow-scroll">
                                <table class="table-auto w-full text-sm  overflow-scroll">
                                    <thead>
                                        <tr>
                                            <th class="px-4 py-2">Nombre completo</th>
                                            <th class="px-4 py-2">Cargo</th>
                                            <th class="px-4 py-2">Acciones</th>

                                        </tr>
                                    </thead>
                                    <tbody class="font-normal">
                                        <?php foreach ($empleados as $empleado) { ?>
                                            <tr>
                                                <td class="border px-4 py-2">
                                                    <?php echo $empleado['nombre']; ?>
                                                    <?php echo $empleado['paterno']; ?>
                                                    <?php echo $empleado['materno']; ?>
                                                </td>
                                                <td class="border px-4 py-2"><?php echo $empleado['cargo']; ?></td>
                                                <!-- Go to employent details -->
                                                <td class="border px-4 py-2">
                                                    <a href="./detalles_empleado.php?empleado_id=<?php echo $empleado['id']; ?>" class="text-blue-600 hover:text-blue-700">Ver</a>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    <?php } ?>
                </div>
            </dd>

        </div>

    </main>

    <!-- Pie de Página -->
    <footer class="bg-blue-600 text-white mt-8 w-screen">
        <div class="container mx-auto p-4 text-center">
            <p>&copy; <?php echo date("Y"); ?> SIMAQ - Todos los derechos reservados</p>
        </div>
    </footer>
    <script>
        const app = new Vue({
            el: '#app',
            data: {

            },
            methods: {

            },
            created: function() {
                //Create chart
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: [
                            <?php foreach ($cantidad_empelados_por_departamento as $item) { ?> '<?php echo $item['nombre']; ?>',
                            <?php } ?>
                        ],
                        datasets: [{
                            label: 'Cantidad de empleados',
                            data: [
                                <?php foreach ($cantidad_empelados_por_departamento as $item) { ?>
                                    <?php echo $item['cantidad']; ?>,
                                <?php } ?>
                            ],

                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                }
                            }
                        }
                    }
                });
            },
        });
    </script>
</body>

</html>