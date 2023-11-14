<?php
include_once('./validators.php');
session_start();

$tipos_membresias = [
    [
        'id' => "mensual",
        'nombre' => 'Mensual'
    ],
    [
        'id' => "anual",
        'nombre' => 'Anual'
    ]
];

$nombre = "";
$paterno = "";
$materno = "";
$rfc = "";
$curp = "";
$membresia = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {

        $nombre = $_POST['nombre'];
        $paterno = $_POST['paterno'];
        $materno = $_POST['materno'];
        $rfc = $_POST['rfc'];
        $curp = $_POST['curp'];
        $membresia = $_POST['membresia'];

        if (isset($_POST['nombre']) && strlen($_POST['nombre']) > 0) {

            $validation = isOnlyCharacters($nombre);
            if (!$validation) {
                throw new Exception("El nombre solo puede contener letras");
            }
        } else {
            throw new Exception("El nombre es requerido");
        }

        if (isset($_POST['paterno']) && strlen($_POST['paterno']) > 0) {

            $validation = isOnlyCharacters($paterno);
            if (!$validation) {
                throw new Exception("El apellido paterno solo puede contener letras");
            }
        } else {
            throw new Exception("El apellido paterno es requerido");
        }

        if (isset($_POST['materno']) && strlen($_POST['materno']) > 0) {

            $validation = isOnlyCharacters($materno);
            if (!$validation) {
                throw new Exception("El apellido materno solo puede contener letras");
            }
        } else {
            throw new Exception("El apellido materno es requerido");
        }

        if (isset($_POST['rfc']) && strlen($_POST['rfc']) > 0) {

            $validation = isValidRFC($rfc);
            if (!$validation) {
                throw new Exception("El RFC no es válido, debe tener 13 caracteres");
            }
        } else {
            throw new Exception("El RFC es requerido");
        }

        if (isset($_POST['curp']) && strlen($_POST['curp']) > 0) {

            $validation = isValidCURP($curp);
            if (!$validation) {
                throw new Exception("El CURP no es válido, debe tener 18 caracteres");
            }
        } else {
            throw new Exception("El CURP es requerido");
        }



        $_SESSION['success_message'] = "Registro exitoso";
    } catch (Exception $e) {
        $_SESSION['message'] = $e->getMessage();
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Registro cliente - PelisNow</title>
    <link rel="stylesheet" href="./../styles.css" />
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
    <div class="form-container">
        <h1>Registro de cliente</h1>
        <form class="login-form" method="POST" action="./AOARegistroCliente.php">
            <label for="nombre">Nombre del cliente:</label>
            <input type="text" id="nombre" name="nombre" value="<?= $nombre ?>" required />

            <!-- Apellido paterno -->
            <label for="paterno">Apellido paterno:</label>
            <input type="text" id="paterno" name="paterno" value="<?= $paterno ?>" required />

            <!-- Apellido materno -->
            <label for="materno">Apellido materno:</label>
            <input type="text" id="materno" name="materno" value="<?= $materno ?>" required />


            <!-- RFC -->
            <label for="rfc">RFC:</label>
            <input type="text" id="rfc" name="rfc" value="<?= $rfc ?>" required />

            <!-- Curp -->
            <label for="curp">CURP:</label>
            <input type="text" id="curp" name="curp" value="<?= $curp ?>" required />

            <!-- Membresia -->
            <label for="membresia">Membresia:</label>
            <select id="membresia" name="membresia" required>
                <?php foreach ($tipos_membresias as $membresia) { ?>
                    <option value="<?= $membresia['id'] ?>"><?= $membresia['nombre'] ?></option>
                <?php } ?>
            </select>

            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert">
                    <p> Error: <?php echo $_SESSION['message']; ?></p>
                </div>
            <?php
                unset($_SESSION['message']);
            } ?>

            <?php if (isset($_SESSION['success_message'])) { ?>
                <div class="success">
                    <p> <?php echo $_SESSION['success_message']; ?></p>
                </div>
            <?php
                unset($_SESSION['success_message']);
            } ?>

            <br />
            <br />
            <button type="submit">Guardar</button>
        </form>
        <footer class="site-footer">
            <div class="footer-bottom">
                <p>AOA – PW1 – Noviembre/2023</p>
            </div>
        </footer>
    </div>

</body>

<script>
    function onSubmit(token) {
        window.location.href = "AOAInicio.php";
    }
</script>

</html>