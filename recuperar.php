<?php
include("conexion.php");

$email = $_POST['email'];

try {

    $consulta = $conn->query("SELECT * FROM clientes WHERE email = '$email'");
    $usuario = $consulta->fetch();

    if ($usuario) {
        echo "<script>
                alert('Si el correo coincide con nuestros registros, recibirás un enlace de recuperación en breve.');
                window.location.href = 'iniciar-sesion.html';
              </script>";
    } else {
        echo "<script>
                alert('El correo ingresado no está registrado.');
                window.history.back();
              </script>";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>