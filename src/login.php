<?php
session_start();

if ($_SESSION) {
  header('index.php');
}
require 'database.php';
require 'Model.php';

if ($_POST) {
  $password = $_POST['password'];
  $email = $_POST['email'];
  $modelo = new Model();
  if ($password && $email) {
    $usuario = $modelo->login($password, $email);

    if ($usuario) {
      $_SESSION['user_id'] = $usuario['id'];
      $_SESSION['email'] = $email;
      $mensaje = "Datos correctos";

      if (intval($usuario['tipo_usuario']) == 0) {
        //Go to index_admin.php  without using header function
        echo "<script> window.location='index_admin.php'; </script>";
      } else {
        header("Location: index.php");
      }
    } else {
      $mensaje = "Datos inválidos";
    }
  } else {
    echo "Ingresa los datos";
  }
}




?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">

  <style type="text/css">
    body {
      background: #f9f2e7;

    }
  </style>

  <title>Login</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

  <img src="img/logo1.jpg">

  <h1>Inicia Sesión</h1>
  <span>

    <div style="margin-bottom: 4px;">o</div>

    <a href="signup.php"> <input type="submit" value="Registrate"></a>
  </span>

  <?php if (!empty($mensaje)) : ?>
    <p> <?= $mensaje ?></p>
  <?php endif; ?>
  <form action="login.php" method="POST">

    <input name="email" type="email" placeholder="Escribe tu correo">
    <input name="password" type="password" placeholder="Escribe tu contraseña">
    <input type="submit" value="Entrar">


    <?php if (!empty($mensaje)) : ?>
      <p> <?= $mensaje ?></p>
    <?php endif; ?>


  </form>
</body>

</html>