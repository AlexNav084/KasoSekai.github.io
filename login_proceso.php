<?php
include("conexion.php");

$email = $_POST['email'];
$pass  = $_POST['password'];

$sql = "SELECT * FROM clientes WHERE email = '$email'";
$consulta = $conn->query($sql);
$usuario = $consulta->fetch();

if ($usuario && password_verify($pass, $usuario['password'])) {
    header("Location: perfil-cliente.html");
} else {
    echo "<script>
            alert('Correo o contraseña incorrectos');
            window.location.href = 'iniciar-sesion.html';
          </script>";
}
?>