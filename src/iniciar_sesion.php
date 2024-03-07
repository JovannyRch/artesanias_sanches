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
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Iniciar sesión</h2>
        <form action="validar_usuario.php" method="POST">
            <div class="form-group">
                <label for="idUsuario" class="form-text">ID Usuario:</label><br>
                <input type="text" id="idUsuario" class="form-control" name="idUsuario" required><br>
            </div>

            <div class="form-group">
                <label class="form-text" for="password">Contraseña:</label><br>
                <input class="form-control" type="password" id="password" name="password" required><br>
            </div>

            <div style="display: flex; gap: 4px; flex-direction: column; gap: 8px; align-items: center;">
                <div>
                    <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
                </div>

                <div>
                    <a href="registrarse.php" class="btn btn-link">
                        Registrarse
                    </a>
                    <a class="btn btn-link" href="index.php">Regresar al inicio</a>
                </div>
            </div>



        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>