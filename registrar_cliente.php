<?php
include("conexion.php");

$nombre    = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$email     = $_POST['email'];
$direccion = $_POST['direccion'];
$password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // Seguridad
$token     = bin2hex(random_bytes(16)); // Genera un código único de activación

try {
    $sql = "INSERT INTO clientes (nombre, apellidos, email, direccion, password, token) 
            VALUES ('$nombre', '$apellidos', '$email', '$direccion', '$password', '$token')";
    
    $conn->exec($sql);

    // Simulación de envío de correo
    echo "<script>
            alert('¡Registro exitoso! Se ha enviado un mensaje de activación a: $email. Por favor, revisa tu bandeja de entrada.');
            window.location.href = 'iniciar_sesion.html';
          </script>";

} catch(PDOException $e) {
    echo "Error al registrar: " . $e->getMessage();
}
?>