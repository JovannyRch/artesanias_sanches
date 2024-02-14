<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro - Instituto México</title>
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
    <h2>Registro de Usuario - Padre de Familia</h2>
    <form action="procesar_registro.php" method="POST">

        <!-- IDUsuario -->
        <label for="idUsuario">IDUsuario:</label><br>
        <input type="text" name="idUsuario" required>


        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellidoPaterno">Apellido Paterno:</label><br>
        <input type="text" id="apellidoPaterno" name="apellidoPaterno" required><br>

        <label for="apellidoMaterno">Apellido Materno:</label><br>
        <input type="text" id="apellidoMaterno" name="apellidoMaterno"><br>

        <label for="edad">Edad:</label><br>
        <input type="number" id="edad" name="edad"><br>

        <label for="sexo">Sexo:</label><br>
        <select id="sexo" name="sexo">
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br>

        <label for="confirm_password">Confirmar Contraseña:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br>

        <input type="hidden" name="tipoUsuario" value="PF">

        <input type="submit" value="Registrarse">

        <p><a href="iniciar_sesion.php">Iniciar sesión</a></p>
        <p><a href="index.php">Regresar al inicio</a></p>
    </form>



</body>

</html>