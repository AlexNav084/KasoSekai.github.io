<?php
include("conexion.php");
session_start();

// VALIDACIÓN: Si no llegan los datos, detenemos el proceso
if (!isset($_POST['productoID']) || empty($_POST['productoID'])) {
    die("Error: No se recibió la información del producto para procesar el pago.");
}

// Recogemos los datos de forma segura
$productoID = $_POST['productoID'];
$precio     = $_POST['precio'];
$total      = $_POST['total'];
$fecha      = date("Y-m-d");
$hora       = date("H:i:s");

try {
    // 1. Insertar en la tabla principal de ventas
    $sql_venta = "INSERT INTO venta (fecha, hora) VALUES (:fecha, :hora)";
    $stmt = $conn->prepare($sql_venta);
    $stmt->execute([':fecha' => $fecha, ':hora' => $hora]);
    
    $ventaID = $conn->lastInsertId();

    // 2. Insertar el detalle de la venta
    $sql_detalle = "INSERT INTO venta_detalle (ventaID, productoID, cantidad, precio, subtotal) 
                    VALUES (:vID, :pID, 1, :precio, :sub)";
    $stmt_det = $conn->prepare($sql_detalle);
    $stmt_det->execute([
        ':vID'    => $ventaID,
        ':pID'    => $productoID,
        ':precio' => $precio,
        ':sub'    => $total
    ]);

    echo "<script>
            alert('¡Compra realizada con éxito en Kaso Sekai!');
            window.location.href = 'perfil-cliente.html';
          </script>";

} catch (PDOException $e) {
    echo "Error crítico en la base de datos: " . $e->getMessage();
}
?>