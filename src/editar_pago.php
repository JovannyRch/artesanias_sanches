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

$pdo = new PDO("mysql:host=db;dbname=pagos_escolares;charset=utf8;", 'root', '');
//$pdo = new PDO("mysql:host=localhost;dbname=auogesej_pagos;charset=utf8;", 'auogesej_pagos', 'DfCU4azC6');

$stm = $pdo->prepare("SELECT * FROM PAGOS WHERE FolioPago = ?");
$stm->execute([$_GET['folio']]);
$pago = $stm->fetch(PDO::FETCH_ASSOC);


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
            Editar pago
        </p>

        <form action="actualizar_pago.php?folio=<?php echo $pago['FolioPago']; ?>" method="post">
            <label for="folio">Folio:</label>
            <input type="text" name="folio" value="<?php echo $pago['FolioPago']; ?>">
            <br>
            <label for="concepto">Concepto:</label>
            <input type="text" name="concepto" id="concepto" value="<?php echo $pago['Concepto']; ?>" required>
            <br>
            <label for="mes">Mes:</label>
            <input type="text" name="mes" id="mes" value="<?php echo $pago['MesPagado']; ?>" required>
            <br>
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo $pago['FechaPago']; ?>" required>
            <br>
            <label for="monto">Monto:</label>
            <input type="number" name="monto" id="monto" value="<?php echo $pago['Monto']; ?>" required>
            <br>

            <br>
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>

</html>