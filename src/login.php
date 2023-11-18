<?php
// Iniciar la sesión
session_start();

// Variables para guardar errores y valores del formulario
$errores = [];
$usuario = '';
$contrasena = '';

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';

    // Aquí deberías verificar el usuario y la contraseña con la base de datos
    // Por ahora, solo simularemos una validación
    if ($usuario === 'admin' && $contrasena === 'admin') {
        // Usuario y contraseña correctos, redirigir al dashboard
        $_SESSION['usuario'] = $usuario; // Guardar el nombre de usuario en la sesión
        header("Location: dashboard.php");
        exit;
    } else {
        $errores[] = 'El nombre de usuario o la contraseña son incorrectos.';
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Login
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="path_to_tailwind.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">



    <main class="container mx-auto p-4 flex-1">
        <?php

        $content = '
    <div class="w-full max-w-xl mx-auto flex h-screen items-center">

       


        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex gap-6" action="login.php" method="POST">

            <div class="w-1/3 flex flex-col justify-start items-center">
                <h1 class="text-center text-3xl font-bold mb-4">Login</h1>
                <img src="./assets/logo.png" alt="Imagen de ejemplo">
            </div>
            <div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="usuario">
                    Usuario
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="usuario" name="usuario" type="text" placeholder="Usuario" value="' . htmlspecialchars($usuario) . '">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="contrasena">
                        Contraseña
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="contrasena" name="contrasena" type="password" placeholder="******************">
                    ' . (!empty($errores) ? '<p class="text-red-500 text-xs italic">' . htmlspecialchars($errores[0]) . '</p>' : '') . '
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Iniciar sesión
                    </button>
                </div>
            </div>
        </form>
    </div>
';

        echo $content;
        ?>
    </main>


</body>

</html>