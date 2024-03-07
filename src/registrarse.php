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
        <h2 class="text-center mb-4">Registro de Usuario - Padre de Familia</h2>

        <form action="procesar_registro.php" style=" display: flex; flex-direction: column; align-items: center; justify-content: center;" method="POST">


            <div class="row">
                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4 ">
                    <label class="form-text" for="idUsuario">IDUsuario:</label><br>
                    <input class="form-control" data-bs-toggle="tooltip" data-bs-title="Ingrese un número de 4 dígitos" type="text" name="idUsuario" required>
                </div>


                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="nombre">Nombre:</label><br>
                    <input data-bs-toggle="tooltip" data-bs-title="Longitud mínima de 3 carácteres con letras" class="form-control" type="text" id="nombre" name="nombre" required><br>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="apellidoPaterno">Apellido Paterno:</label><br>
                    <input data-bs-toggle="tooltip" data-bs-title="Longitud mínima de 3 carácteres con letras" class="form-control" type="text" id="apellidoPaterno" name="apellidoPaterno" required><br>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="apellidoMaterno">Apellido Materno:</label><br>
                    <input data-bs-toggle="tooltip" data-bs-title="Longitud mínima de 3 carácteres con letras" class="form-control" type="text" id="apellidoMaterno" name="apellidoMaterno"><br>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="edad">Edad:</label><br>
                    <input data-bs-toggle="tooltip" data-bs-title="Ingrese edad válida, mayor que 0" class="form-control" type="number" id="edad" name="edad"><br>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="sexo">Sexo:</label><br>
                    <select class="form-select" id="sexo" name="sexo" data-bs-toggle="tooltip" data-bs-title="Elija un genéro físico">
                        <option value="M">Masculino</option>
                        <option value="F">Femenino</option>
                    </select><br>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="email">Email:</label><br>
                    <input data-bs-toggle="tooltip" data-bs-title="Ingrese email válido" class="form-control" type="email" id="email" name="email" required><br>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="password">Contraseña:</label><br>
                    <input data-bs-toggle="tooltip" data-bs-title="Longitud mínima de 8 posiciones, con letras y números y por lo menos un carácter especial (#,$,-,_,&,%)" class="form-control" type="password" id="password" name="password" required><br>
                </div>

                <div class="row col-sm-12 col-md-6 col-lg-4 mb-4">
                    <label class="form-text" for="confirm_password">Confirmar Contraseña:</label><br>
                    <input data-bs-toggle="tooltip" data-bs-title="Repita la contraseña ingresada previamente" class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                </div>
            </div>

            <input class="form-control" type="hidden" name="tipoUsuario" value="PF">
            <br>
            <input class="btn btn-primary" type="submit" value="Registrarse">
            <br>
            <div style="display: flex; gap: 4px; ">
                <a href="iniciar_sesion.php" class="btn btn-link">Iniciar sesión</a>

                <a href="index.php" class="btn btn-link">Regresar</a>
            </div>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>
</body>

</html>