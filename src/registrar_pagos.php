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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

        .container {
            min-height: 100vh;
            padding-top: 100px;
            gap: 8px;
        }
    </style>

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


            <div class="row">
                <div class="form-group mb-2 col-lg-4 col-md-6 col-sm-12">
                    <label class="form-text" for="folio">Folio:</label>
                    <input class="form-control" type="text" name="folio">
                </div>

                <div class="form-group mb-2 col-lg-4 col-md-6 col-sm-12">
                    <label class="form-text" for="concepto">Concepto:</label>
                    <input class="form-control" type="text" name="concepto" id="concepto" required>
                </div>

                <div class="form-group mb-2 col-lg-4 col-md-6 col-sm-12">
                    <label class="form-text" for="mes">Mes:</label>
                    <input class="form-control" type="text" name="mes" id="mes" required>
                </div>


                <div class="form-group mb-2 col-lg-4 col-md-6 col-sm-12">
                    <label class="form-text" for="monto">Monto:</label>
                    <input class="form-control" type="number" name="monto" id="monto" required>
                </div>


                <div class="form-group mb-2 col-lg-4 col-md-6 col-sm-12">
                    <label class="form-text" for="idUsuario">Usuario:</label>
                    <select class="form-select" name="idUsuario" id="idUsuario">
                        <?php foreach ($users as $user) : ?>
                            <option value="<?php echo $user['IDUsuario']; ?>">
                                <?php echo $user['Nombre']; ?>
                                <?php echo $user['ApellidoPaterno']; ?>
                                <?php echo $user['ApellidoMaterno']; ?>

                            </option>
                        <?php endforeach; ?>
                    </select>

                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <input class="btn btn-primary " type="submit" value="Registrar">
                </div>

            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>