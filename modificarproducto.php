<?php
include("conexion.php");

$id             = $_POST['productoID'];
$sku            = $_POST['sku'];
$nombre         = $_POST['nombre'];
$precio         = $_POST['precio'];
$stock          = $_POST['stock'];
$nombre_cliente = $_POST['nombre_cliente'];
$estado         = $_POST['estado'];
$imagen         = $_POST['imagen'];

try {
    // Usamos nombres de columnas con guion bajo para evitar errores de sintaxis
    $sql = "UPDATE producto 
            SET sku='$sku', nombre='$nombre', precio='$precio', stock='$stock', 
                nombre_cliente='$nombre_cliente', estado='$estado', imagen='$imagen'
            WHERE productoID='$id'";

    $conn->exec($sql);
    header("Location: gerente-cuenta.php");
    exit();
} catch(PDOException $e) {
    echo "Error al actualizar: " . $e->getMessage();
}
?>