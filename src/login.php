<?php
session_start(); // Inicia la sesión para poder guardar el mensaje de error.

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_admin = 'admin_aoa';
    $password_admin = 'ES202105032';

    $user_suscriptor = 'mostrador_aoa';
    $password_suscriptor = 'ES202105032';


    if ($username == $user_admin && $password == $password_admin) { //Las credenciales de administrador son: admin_aoa / ES202105032
        header('Location: ./AOAAdminInicio.php'); // Redirige a la sección de administrador.
    } else if ($username == $user_suscriptor && $password == $password_suscriptor) { //Las credenciales de suscriptor son: mostrador_aoa / ES202105032
        header('Location: ./AOAInicio.php'); // Redirige a la sección de suscriptor.
    } else {
        $_SESSION['message'] = 'Usuario o contraseña incorrectos'; // Si las credenciales son incorrectas, se muestra un mensaje de error.
        header('Location: ./AOALogin.php'); // Redirige a la página de login.
    }
}
