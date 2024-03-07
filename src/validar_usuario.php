<?php
session_start();
require_once 'db.php';

$db = new Database();

$idUsuario = $_POST['idUsuario'];
$password = $_POST['password'];

$sql = "SELECT IDUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, TipoUsuario, Password FROM USUARIOS 
WHERE IDUsuario = '$idUsuario' AND Password = '$password'";

$db->query($sql);

$sql = "SELECT * FROM USUARIOS WHERE IDUsuario = '$idUsuario'";
$result = $db->array($sql);

$user = null;

if (sizeof($result) > 0) {
    $user = $result[0];
    $_SESSION['idUsuario'] = $user['IDUsuario'];
    $_SESSION['usuario'] = $user['Nombre'] . " " . $user['ApellidoPaterno'] . " " . $user['ApellidoMaterno'];
    $_SESSION['tipoUsuario'] = $user['TipoUsuario'];
} else {
    echo "Usuario no registrado.";
    die();
}

$db->close();

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
            flex-direction: column;
            justify-content: center;
            align-items: center;
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

        <div style="max-width: 10%; margin: 0 auto;">
            <img src="https://edutory.mx/wp-content/uploads/2023/02/instituto-mexico-secundaria-ims-logo-1006x1024.png" />
        </div>
        <div>
            <h1>Bienvenido <?php echo $_SESSION['usuario'] ?></h1>
            <p>Usted ha iniciado sesión como <?php echo $_SESSION['tipoUsuario'] ?></p>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>