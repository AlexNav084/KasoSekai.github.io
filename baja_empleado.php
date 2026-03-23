<?php
session_start();
include("conexion.php");

// Verificamos que llegue un ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // 1. Verificación de Seguridad: ¿Tiene procesos o sesiones pendientes?
        $check = $conn->query("SELECT sesiones_activas, nombre FROM empleados WHERE id='$id'");
        $empleado = $check->fetch(PDO::FETCH_ASSOC);

        if ($empleado['sesiones_activas'] > 0) {
            // Bloqueo si hay sesiones abiertas
            echo "<script>
                    alert('ERROR: No se puede eliminar a " . $empleado['nombre'] . " porque tiene una sesión activa en el sistema.');
                    window.location.href='gestion-usuarios.php';
                  </script>";
        } else {
            // 2. Ejecutar la eliminación
            $sql = "DELETE FROM empleados WHERE id='$id'";
            $conn->exec($sql);

            // Redirección inmediata tras eliminar
            header("Location: gestion-usuarios.php");
            exit();
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    // Si alguien entra a este archivo sin un ID, lo regresamos
    header("Location: gestion-usuarios.php");
    exit();
}
?>