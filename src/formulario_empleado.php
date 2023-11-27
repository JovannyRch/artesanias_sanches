<?php
include_once './menu.php';
include_once './db.php';


session_start();
$db = new Database();


if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$is_edit = isset($_GET['id']);

$title = $is_edit ? "Editar Empleado" : "Registrar Empleado";

$empleado = [
    "nombre" => "",
    "paterno" => "",
    "materno" => "",
    "telefono" => "",
    "email" => "",
    "departamento_id" => "",
    "cargo_id" => "",
    "estatus_empleado" => "",
    "fecha_ingreso" => "",
    "rfc" => "XEXX010101HNE",
    "curp" => "XEXX010101HNEXXXA4",
];

if ($is_edit) {
    $id = $_GET['id'];
    $empleado = $db->row("SELECT * FROM empleados WHERE id = $id");
    if (!$empleado) {
        header("Location: empleados.php");
        exit;
    }
}






if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $paterno = $_POST['paterno'];
    $materno = $_POST['materno'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $departamento_id = $_POST['departamento_id'];
    $cargo_id = $_POST['cargo_id'];
    $status = $_POST['estatus_empleado'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $curp = $_POST['curp'];
    $rfc = $_POST['rfc'];

    //2023-11-01
    $fecha_ingreso = date("Y-m-d", strtotime($fecha_ingreso));

    if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $response = $db->query("UPDATE empleados SET nombre = '$nombre', curp = '$curp', rfc = '$rfc', paterno = '$paterno', materno = '$materno', telefono = '$telefono', email = '$email', departamento_id = $departamento_id, cargo_id = $cargo_id, estatus_empleado = '$status', fecha_ingreso = '$fecha_ingreso' WHERE id = $id");

        if ($response) {
            header("Location: empleados.php");
            exit;
        } else {
            $_SESSION['error'] = "Error al editar el empleado";
        }
    } else {
        $response = $db->query("INSERT INTO empleados(curp, rfc, nombre, paterno, materno, telefono, email, departamento_id, cargo_id, estatus_empleado, fecha_ingreso) VALUES ('$curp', '$rfc', '$nombre', '$paterno', '$materno', '$telefono', '$email', $departamento_id, $cargo_id, '$status', '$fecha_ingreso')");

        if ($response) {
            header("Location: empleados.php");
            exit;
        } else {
            $_SESSION['error'] = "Error al crear el empleado";
        }
    }
}

$departamentos = $db->array("SELECT * FROM departamentos");

$departamentos = array_map(function ($departamento) {
    return [
        "value" => $departamento['id'],
        "label" => $departamento['nombre']
    ];
}, $departamentos);

$cargos = $db->array("SELECT * FROM cargos");

$cargos = array_map(function ($cargo) {
    return [
        "value" => $cargo['id'],
        "label" => $cargo['nombre']
    ];
}, $cargos);

$status_options = array_map(function ($status) {
    return [
        "value" => $status,
        "label" => $status
    ];
}, $status);

$fields = [
    "nombre" => [
        "type" => "text",
        "label" => "Nombre",
        "placeholder" => "Ingrese nombre del empleado",
        "required" => true,
        "value" => $empleado['nombre']
    ],
    "paterno" => [
        "type" => "text",
        "label" => "Apellido Paterno",
        "placeholder" => "Ingrese apellido paterno",
        "required" => true,
        "value" => $empleado['paterno']
    ],
    "materno" => [
        "type" => "text",
        "label" => "Apellido Materno",
        "placeholder" => "Ingrese apellido materno",
        "required" => true,
        "value" => $empleado['materno']
    ],
    "telefono" => [
        "type" => "text",
        "label" => "Telefono",
        "placeholder" => "Ingrese telefono",
        "required" => true,
        "value" => $empleado['telefono']
    ],
    "email" => [
        "type" => "email",
        "label" => "Email",
        "placeholder" => "Ingrese email",
        "required" => true,
        "value" => $empleado['email']
    ],
    "curp" => [
        "type" => "text",
        "label" => "CURP",
        "placeholder" => "Ingrese CURP",
        "required" => true,
        "value" => $empleado['curp']
    ],
    "rfc" => [
        "type" => "text",
        "label" => "RFC",
        "placeholder" => "Ingrese RFC",
        "required" => true,
        "value" => $empleado['rfc']
    ],
    "cargo_id" => [
        "type" => "select",
        "label" => "Cargo",
        "placeholder" => "Seleccione un cargo",
        "required" => true,
        "value" => $empleado['cargo_id'],
        "options" => $cargos

    ],
    "departamento_id" => [
        "type" => "select",
        "label" => "Departamento",
        "placeholder" => "Seleccione un departamento",
        "required" => true,
        "value" => $empleado['departamento_id'],
        "options" => $departamentos
    ],
    "estatus_empleado" => [
        "type" => "select",
        "label" => "Estado",
        "placeholder" => "Seleccione un estado",
        "required" => true,
        "value" => $empleado['estatus_empleado'],
        "options" => $status_options
    ],
    "fecha_ingreso" => [
        "type" => "date",
        "label" => "Fecha de Ingreso",
        "placeholder" => "Ingrese fecha de ingreso",
        "required" => true,
        "value" => $empleado['fecha_ingreso']
    ],
];


if ($is_edit) {
    $fields['id'] = [
        "type" => "hidden",
        "value" => $empleado['id']
    ];
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
    <script src="./assets//tailwind.js"></script>
    <script src="./assets/chart.js"></script>
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
    <main class="container mx-auto p-4 flex-1">
        <form class="max-w-lg mx-auto pt-8" method="POST" action="./formulario_empleado.php">
            <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8 ">
                <?php echo $title ?>
            </h1>

            <?php foreach ($fields as $name => $field) {
                if ($field['type'] === 'hidden') { ?>
                    <input type="hidden" name="<?php echo $name; ?>" value="<?php echo $field['value']; ?>">
                <?php } else if ($field['type'] === 'select') { ?>
                    <div class="mb-5">
                        <label for="<?php echo $name; ?>" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200"><?php echo $field['label']; ?></label>
                        <select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value=""><?php echo $field['placeholder']; ?></option>
                            <?php foreach ($field['options'] as $option) { ?>
                                <option value="<?php echo $option['value']; ?>" <?php echo $option['value'] === $field['value'] ? 'selected' : ''; ?>><?php echo $option['label']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                <?php } else if ($field['type'] === 'date') { ?>

                    <div class="mb-5">
                        <label for="<?php echo $name ?>" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200"><?php echo $field['label'] ?></label>
                        <input type="<?php echo $field['type'] ?>" name="<?php echo $name ?>" id="<?php echo $name ?>" placeholder="<?php echo $field['placeholder'] ?>" required="<?php echo $field['required'] ?>" value="<?php echo $field['value'] ?>" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 focus:outline-none focus:ring">
                    </div>

                <?php } else { ?>
                    <div class="mb-5">
                        <label for="<?php echo $name ?>" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-200"><?php echo $field['label'] ?></label>
                        <input type="<?php echo $field['type'] ?>" name="<?php echo $name ?>" id="<?php echo $name ?>" placeholder="<?php echo $field['placeholder'] ?>" required="<?php echo $field['required'] ?>" value="<?php echo $field['value'] ?>" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 focus:outline-none focus:ring">
                    </div>
                <?php } ?>

            <?php } ?>



            <?php if (isset($_SESSION['error'])) { ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline"><?php echo $_SESSION['error']; ?></span>
                </div>
            <?php
                unset($_SESSION['error']);
            } ?>

            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Guardar
            </button>
        </form>
    </main>

    <!-- Pie de Página -->
    <footer class="bg-blue-600 text-white mt-8 w-screen">
        <div class="container mx-auto p-4 text-center">
            <p>&copy; <?php echo date("Y"); ?> SIMAQ - Todos los derechos reservados</p>
        </div>
    </footer>

</body>

</html>