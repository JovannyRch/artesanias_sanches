<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Ingreso - PelisNow</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <div class="login-container">
    <h1>Bienvenido a PelisNow</h1>
    <form class="login-form" method="POST" action="./login.php">
      <label for="username">Usuario:</label>
      <input type="text" id="username" name="username" required />

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required />

      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert">
          <p><?php echo $_SESSION['message']; ?></p>
        </div>
      <?php
        unset($_SESSION['message']);
      } ?>
      <button type="submit">Iniciar sesión</button>
    </form>
    <p>¿No tienes cuenta? <a href="AOARegistro.php">Regístrate aquí</a>.</p>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>