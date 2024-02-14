<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #0056b3;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #004494;
        }
    </style>
</head>

<body>
    <form action="validar_usuario.php" method="POST">
        <label for="idUsuario">ID Usuario:</label><br>
        <input type="text" id="idUsuario" name="idUsuario" required><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Iniciar Sesión">

        <p><a href="registrarse.php">
                Registrarse
            </a></p>
        <p><a href="index.php">Regresar al inicio</a></p>
    </form>
</body>

</html>