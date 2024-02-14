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
    <div style="max-width: 10%">
        <img src="https://edutory.mx/wp-content/uploads/2023/02/instituto-mexico-secundaria-ims-logo-1006x1024.png" />
    </div>
    <div class="container">
        <h1>Bienvenido <?php echo $_SESSION['usuario'] ?></h1>
        <p>Usted ha iniciado sesión como <?php echo $_SESSION['tipoUsuario'] ?></p>


    </div>
</body>

</html>