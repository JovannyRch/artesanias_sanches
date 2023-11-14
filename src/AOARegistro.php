<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <title>Registro - PelisNow</title>
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  <div class="register-container">
    <h1>Crear Cuenta en PelisNow</h1>
    <form class="register-form" action="/submit-registration" method="post">
      <label for="fullname">Nombre</label>
      <input type="text" id="fullname" name="fullname" required />

      <label for="lastname">Apellido Paterno:</label>
      <input type="text" id="lastname" name="lastname" required />

      <label for="lastname2">Apellido Materno:</label>
      <input type="text" id="lastname2" name="lastname2" required />

      <label for="curp">CURP:</label>
      <input type="text" id="curp" name="curp" required />

      <!-- RFC -->
      <label for="rfc">RFC:</label>
      <input type="text" id="rfc" name="rfc" required />

      <!-- Tipo de membresia (anual o mensual) -->
      <label for="membership">Tipo de Membresía:</label>
      <select id="membership" name="membership" required>
        <option value="anual">Anual</option>
        <option value="mensual">Mensual</option>
      </select>

      <label for="email">Correo Electrónico:</label>
      <input type="email" id="email" name="email" required />

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required />

      <label for="confirm-password">Confirmar Contraseña:</label>
      <input type="password" id="confirm-password" name="confirm-password" required />

      <button type="submit">Registrarse</button>
    </form>
    <p>¿Ya tienes una cuenta? <a href="AOALogin.php">Inicia sesión</a>.</p>
  </div>
  <footer class="site-footer">
    <div class="footer-bottom">
      <p>AOA – PW1 – Noviembre/2023</p>
    </div>
  </footer>
</body>

</html>