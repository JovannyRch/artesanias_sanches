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
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
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
            Editar pago
        </p>

        <form action="actualizar_pago.php?folio=<?php echo $pago['FolioPago']; ?>" method="post">
            <div class="form-group mb-2">
                <label class="form-text" for="folio">Folio:</label>
                <input class="form-control" type="text" name="folio" value="<?php echo $pago['FolioPago']; ?>">
            </div>

            <div class="form-group mb-2">
                <label class="form-text" for="concepto">Concepto:</label>
                <input class="form-control" type="text" name="concepto" id="concepto" value="<?php echo $pago['Concepto']; ?>" required>
            </div>

            <div class="form-group mb-2">
                <label class="form-text" for="mes">Mes:</label>
                <input class="form-control" type="text" name="mes" id="mes" value="<?php echo $pago['MesPagado']; ?>" required>
            </div>


            <div class="form-group mb-2">
                <label class="form-text" for="fecha">Fecha:</label>
                <input class="form-control" type="date" name="fecha" id="fecha" value="<?php echo $pago['FechaPago']; ?>" required>
            </div>

            <div class="form-group mb-2">
                <label class="form-text" for="monto">Monto:</label>
                <input class="form-control" type="number" name="monto" id="monto" value="<?php echo $pago['Monto']; ?>" required>
            </div>

            <input type="submit" class="btn btn-primary mt-2" value="Actualizar">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>