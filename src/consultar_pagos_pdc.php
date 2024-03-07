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

        .container {
            min-height: 100vh;
            padding-top: 100px;
            gap: 8px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>

    <nav class="navbar fixed-top navbar-expand-lg bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">Instituto Mexicano</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                    </svg>

                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white">

                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Inicio</a>
                    </li>
                    <?php if (isset($_SESSION['tipoUsuario'])) : ?>
                        <?php if ($_SESSION['tipoUsuario'] == 'PDC') : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="consultar_pagos.php">Consultar pagos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="registrar_pagos.php">Registrar pagos</a>
                            </li>
                        <?php elseif ($_SESSION['tipoUsuario'] == 'PF') : ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="consultar_pagos.php">Consultar pagos</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="logout.php">Salir</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="registrarse.php">Registrarse</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="iniciar_sesion.php">Iniciar sesión</a>
                        </li>
                    <?php endif; ?>

                </ul>

            </div>
        </div>
    </nav>

    <div class="container">

        <div style="max-width: 10%">
            <img src="https://edutory.mx/wp-content/uploads/2023/02/instituto-mexico-secundaria-ims-logo-1006x1024.png" />
        </div>
        <p>
            Padre de familia: <b><?php echo $_SESSION['idUsuario']; ?></b>
            Nombre: <b><?php echo $_SESSION['usuario']; ?></b>
        </p>

        <form method="POST" action="consultar_pagos_pdc.php">

            <div class="form-group">
                <label for="idUsuario" class="form-text">ID Usuario:</label>
                <input type="text" class="form-control" id="idUsuario" name="idUsuario" value="<?php echo isset($_POST['idUsuario']) ? $_POST['idUsuario'] : '' ?>" required />
            </div>

            <input type="submit" class="btn btn-primary mt-2" value="Consultar pagos" />
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

            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-dark">
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
                                    <a class="btn btn-warning" href="editar_pago.php?folio=<?php echo $pago['FolioPago']; ?>">Editar</a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="eliminar_pago.php?folio=<?php echo $pago['FolioPago']; ?>">Eliminar</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>