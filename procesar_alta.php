<?php
// 1. Forzamos la inclusión de la conexión
require_once("conexion.php");

// 2. Verificamos que los datos llegaron por POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $nombre = $_POST['nombre'];
    $rol    = $_POST['rol'];
    $ventas = $_POST['ventas'];

    try {
        // Usamos la variable $conn que definimos en conexion.php
        $sql = "INSERT INTO empleados (nombre, rol, estado, ventas_totales, sesiones_activas) 
                VALUES ('$nombre', '$rol', 'Activo', '$ventas', 0)";
        
        $conn->exec($sql);

        echo "<script>
                alert('¡Empleado guardado con éxito!');
                window.location.href='gestion-usuarios.php';
              </script>";
              
    } catch(PDOException $e) {
        echo "Error en la base de datos: " . $e->getMessage();
    }
} else {
    echo "No se recibieron datos.";
}
?>