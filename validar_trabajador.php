<?php
include("conexion.php");
session_start();

// En un sistema real, aquí consultarías tu tabla de 'usuarios' con rol 'trabajador'
// Para este ejemplo, usaremos datos fijos: Usuario 'admin' Pass 'staff123'
$user_valido = "admin";
$pass_valida = "staff123";

$usuario_ingresado = $_POST['usuario'];
$password_ingresado = $_POST['password'];

if ($usuario_ingresado === $user_valido && $password_ingresado === $pass_valida) {
    
    // 1. Guardamos datos en la sesión
    $_SESSION['trabajador'] = $usuario_ingresado;
    
    // 2. Registramos la hora de entrada
    try {
        $fecha_actual = date("Y-m-d H:i:s");
        $sql = "INSERT INTO asistencias (nombre_trabajador, hora_entrada) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usuario_ingresado, $fecha_actual]);
        
        // 3. Redirigir al panel
        header("Location: panel_trabajador.php");
    } catch(PDOException $e) {
        echo "Error al registrar entrada: " . $e->getMessage();
    }

} else {
    echo "<script>alert('Datos incorrectos'); window.location.href='login_trabajador.php';</script>";
}
?>