<?php
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id     = $_POST['id'];
    $nombre = $_POST['nombre'];
    $rol    = $_POST['rol'];
    $estado = $_POST['estado'];

    try {
        $sql = "UPDATE empleados 
                SET nombre='$nombre', rol='$rol', estado='$estado' 
                WHERE id='$id'";
        
        $conn->exec($sql);

        echo "<script>
                alert('Perfil actualizado correctamente.');
                window.location.href='gestion-usuarios.php';
              </script>";
    } catch(PDOException $e) {
        echo "Error al actualizar: " . $e->getMessage();
    }
}
?>