<?php
require_once 'db.php'; // Incluir la conexión a la base de datos

$db = new Database();

// Recibir datos del formulario
$idUsuario = $_POST['idUsuario'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellidoPaterno = $_POST['apellidoPaterno'] ?? '';
$apellidoMaterno = $_POST['apellidoMaterno'] ?? '';
$edad = $_POST['edad'] ?? '';
$sexo = $_POST['sexo'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$confirm_password = $_POST['confirm_password'] ?? '';
$tipoUsuario = 'PF';


//Validdar idUsuario no exista
$sql = "SELECT * FROM USUARIOS WHERE IDUsuario = $idUsuario";
$result = $db->array($sql);

if (sizeof($result) > 0) {
    echo "El IDUsuario ya está registrado.";
    exit;
}


// Validar que ningún campo requerido esté vacío
if (empty($nombre) || empty($apellidoPaterno) || empty($email) || empty($password) || empty($confirm_password)) {
    echo "Por favor, completa todos los campos requeridos.";
    exit;
}

// Validar que las contraseñas coincidan
if ($password !== $confirm_password) {
    echo "Las contraseñas no coinciden.";
    exit;
}

// Validar la longitud y composición de la contraseña
$pattern = '/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[#\$\-_&%])[A-Za-z\d#\$\-_&%]{8,}$/';
if (!preg_match($pattern, $password)) {
    echo "La contraseña debe tener al menos 8 caracteres, incluyendo letras, números y al menos un carácter especial (#, $, -, _, &, %).";
    exit;
}

// Preparar la consulta SQL
$sql = "INSERT INTO USUARIOS (IDUsuario,Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Sexo, Email, TipoUsuario, Password)
 VALUES ('$idUsuario','$nombre', '$apellidoPaterno', '$apellidoMaterno', $edad, '$sexo', '$email', '$tipoUsuario', '$password')";

try {
    $db->query($sql);
    echo "¡Registro exitoso!";
} catch (Exception $e) {
    echo "Error al registrar el usuario: " . $e->getMessage();
}

$db->close();
