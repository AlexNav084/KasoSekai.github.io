<?php
session_start();

$user_input = $_POST['usuario'] ?? '';
$pass_input = $_POST['password'] ?? '';

// ESTO ES PARA PROBAR: Borra estas líneas después de que funcione
echo "Usuario recibido: [" . $user_input . "]<br>";
echo "Password recibido: [" . $pass_input . "]<br>";

if ($user_input === "jefe_kaso" && $pass_input === "admin1234") {
    echo "¡Coinciden! Intentando redirigir...";
    header("Location: perfil_jefe.php");
    exit();
} else {
    echo "No coinciden.";
}
?>