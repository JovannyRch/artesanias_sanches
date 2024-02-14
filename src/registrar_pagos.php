<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header('Location: iniciar_sesion.php');
    exit;
}

if ($_SESSION['tipoUsuario'] !== 'PDC') {
    header('Location: consultar_pagos.php');
    exit;
}

$userId = $_SESSION['idUsuario'];

$pdo = new PDO("mysql:host=db;dbname=pagos_escolares;charset=utf8;", 'root', '');
//$pdo = new PDO("mysql:host=localhost;dbname=auogesej_pagos;charset=utf8;", 'auogesej_pagos', 'DfCU4azC6');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folio = $_POST['folio'];
    $concepto = $_POST['concepto'];
    $mes = $_POST['mes'];
    $monto = $_POST['monto'];
    $id = $_POST['idUsuario'];
    $fecha = date('Y-m-d H:i:s');

    $sql = "INSERT INTO PAGOS (FolioPago, Concepto, MesPagado, Monto, IDUsuario, FechaPago) VALUES ('$folio', '$concepto', '$mes', '$monto', '$id', '$fecha')";
    $prepared = $pdo->prepare($sql);
    $prepared->execute();

    $_SESSION['message'] = 'Pago registrado';
    header('Location: registrar_pagos.php');

    exit;
}

$stm = $pdo->prepare("SELECT * FROM USUARIOS WHERE TipoUsuario = 'PF'");
$stm->execute();
$users = $stm->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Instituto México - Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            display: flex;
            width: 100%;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin-top: 12px;
        }

        p {
            max-width: 80vw;
        }

        nav {
            background-color: #004d99;
            color: white;
            padding: 10px 0;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        img {
            max-width: 100%;
            height: auto;
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .success-msg {
            color: #270;
            background-color: #DFF2BF;
            margin: 10px 0;
            padding: 10px;
            border-radius: 3px 3px 3px 3px;
        }
    </style>
</head>

<body>

    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <?php if (isset($_SESSION['tipoUsuario'])) : ?>
                <?php if ($_SESSION['tipoUsuario'] == 'PDC') : ?>
                    <li><a href="consultar_pagos.php">Consultar pagos</a></li>
                    <li><a href="registrar_pagos.php">Registrar pagos</a></li>
                <?php elseif ($_SESSION['tipoUsuario'] == 'PF') : ?>
                    <li><a href="consultar_pagos.php">Consultar pagos</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Salir</a></li>
            <?php else : ?>
                <li><a href="registrarse.php">Registrarse</a></li>
                <li><a href="iniciar_sesion.php">Iniciar sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <header>
        <h1>Instituto México</h1>
    </header>
    <div class="container">

        <div style="max-width: 10%">
            <img src="https://edutory.mx/wp-content/uploads/2023/02/instituto-mexico-secundaria-ims-logo-1006x1024.png" />
        </div>
        <p>
            Registrar pago
        </p>

        <!-- Display success message -->
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="success-msg">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>

        <form action="registrar_pagos.php" method="post">

            <input type="hidden" name="idUsuario" value="<?php echo $userId; ?>">

            <label for="folio">Folio:</label>
            <input type="text" name="folio">
            <br>
            <label for="concepto">Concepto:</label>
            <input type="text" name="concepto" id="concepto" required>
            <br>
            <label for="mes">Mes:</label>
            <input type="text" name="mes" id="mes" required>
            <br>
            <label for="monto">Monto:</label>
            <input type="number" name="monto" id="monto" required>
            <br>

            <label for="idUsuario">Usuario:</label>
            <select name="idUsuario" id="idUsuario">
                <?php foreach ($users as $user) : ?>
                    <option value="<?php echo $user['IDUsuario']; ?>">
                        <?php echo $user['Nombre']; ?>
                        <?php echo $user['ApellidoPaterno']; ?>
                        <?php echo $user['ApellidoMaterno']; ?>

                    </option>
                <?php endforeach; ?>
            </select>

            <br>
            <input type="submit" value="Registrar">
        </form>
    </div>
</body>

</html>