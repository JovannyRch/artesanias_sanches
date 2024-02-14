<?php
session_start();


if (!isset($_SESSION['idUsuario'])) {
    header('Location: iniciar_sesion.php');
    exit;
}

if ($_SESSION['tipoUsuario'] === 'PF') {
    header('Location: consultar_pagos.php');
    exit;
}



$pdo = new PDO("mysql:host=db;dbname=pagos_escolares;charset=utf8;", 'root', '');
//$pdo = new PDO("mysql:host=localhost;dbname=auogesej_pagos;charset=utf8;", 'auogesej_pagos', 'DfCU4azC6');

$pagos = [];

if (isset($_POST['idUsuario'])) {
    $idUser = $_POST['idUsuario'];
    $query = "SELECT * FROM PAGOS WHERE IDUsuario = '$idUser'";
    $stm = $pdo->prepare($query);
    $stm->execute();
    $pagos = $stm->fetchAll(PDO::FETCH_ASSOC);
}

$pdo = null;


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

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
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
            Padre de familia: <b><?php echo $_SESSION['idUsuario']; ?></b>
            Nombre: <b><?php echo $_SESSION['usuario']; ?></b>
        </p>

        <form method="POST" action="consultar_pagos_pdc.php">
            <label for="idUsuario">ID Usuario:</label>
            <input type="text" id="idUsuario" name="idUsuario" value="<?php echo isset($_POST['idUsuario']) ? $_POST['idUsuario'] : '' ?>" required />
            <input type="submit" value="Consultar pagos" />
        </form>
        <br />
        <br />
        <h3 style="margin-top: 12px">Pagos realizados
            <?php if (isset($_POST['idUsuario'])) : ?>
                por el usuario <?php echo $_POST['idUsuario']; ?>
            <?php endif; ?>

        </h3>

        <?php if (count($pagos) === 0) : ?>
            <p>No se encontraron pagos</p>
        <?php endif; ?>
        <?php if (count($pagos) > 0) : ?>

            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th>Concepto</th>
                        <th>Mes</th>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pagos as $pago) : ?>
                        <tr>
                            <td><?php echo $pago['FolioPago']; ?></td>
                            <td><?php echo $pago['Concepto']; ?></td>
                            <td><?php echo $pago['MesPagado']; ?></td>
                            <td><?php echo $pago['Monto']; ?></td>
                            <td><?php echo $pago['FechaPago']; ?></td>
                            <td>
                                <a href="editar_pago.php?folio=<?php echo $pago['FolioPago']; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="eliminar_pago.php?folio=<?php echo $pago['FolioPago']; ?>">Eliminar</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>

</html>