<?php
include("conexion.php");

if (isset($_POST['productoID'])) {
    $id = $_POST['productoID'];

    try {     
        // En lugar de DELETE, usamos UPDATE
        $sql = "UPDATE producto SET estado='Inactivo' WHERE productoID='$id'";
        $conn->exec($sql);

        header("Location: gerente-cuenta.php?mensaje=desactivado");
        exit();
    } catch(PDOException $e) {
        echo "Error al desactivar: " . $e->getMessage();
    }
}
?>