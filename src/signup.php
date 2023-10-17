<?php

require 'database.php';
require 'Model.php';

$model = new Model();


$message = '';
if (!empty($_POST['nombre']) && !empty($_POST['email']) && !empty($_POST['password'])) {

  if ($model->existeUsuario($_POST['email'])) {
    $message = 'El correo ya existe';
  } else {
    $sql = "INSERT INTO usuarios (nombre,email,password) 
    VALUES (:nombre,:email,:password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);
    if ($stmt->execute()) {
      $message = 'Usuario creado exitosamente';
    } else {
      $message = 'Ocurrió un problema al crear el usuario';
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>SignUp</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
  <style type="text/css">
    body {
      background: #f9f2e7;

    }
  </style>
</head>

<body>




  <img src="img/logo1.jpg">
  <h1>Registrar usuario</h1>
  <span>
    <div style="margin-bottom: 4px;">o</div> <a href="login.php"> <input type="submit" value="Iniciar Sesión"></a>
  </span>

  <div>
    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
  </div>

  <form action="signup.php" method="POST" autocomplete="off">
    <input required name="email" type="text" placeholder="E-mail">
    <input required name="nombre" type="text" placeholder="Nombre">
    <input name="password" type="password" placeholder="Contraseña"> <!-- PENDIENTE -->
    <input required type="submit" value="Aceptar">
  </form>

</body>

</html>