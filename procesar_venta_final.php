<?php
include("conexion.php");
session_start();
date_default_timezone_set('America/Mexico_City');

$productos = json_decode($_POST['json_productos'], true);
$total = $_POST['total_pago'];
$metodo = $_POST['metodo'];
$vendedor = $_SESSION['trabajador'];

// Flujo Alterno: Simulación de Pago Rechazado
if ($metodo == "Tarjeta" && rand(1, 10) == 1) {
    echo "<script>alert('TRANSACCIÓN RECHAZADA por el banco. Intente con otro método.'); window.history.back();</script>";
    exit();
}

try {
    $conn->beginTransaction();

    foreach ($productos as $item) {
        // Descontar Stock
        $stmt = $conn->prepare("UPDATE productos SET stock = stock - 1 WHERE id = ?");
        $stmt->execute([$item['id']]);
    }

    // Registrar Venta
    $sql_v = "INSERT INTO ventas (producto_lista, total, metodo_pago, vendedor, fecha) VALUES (?, ?, ?, ?, NOW())";
    $stmt_v = $conn->prepare($sql_v);
    $stmt_v->execute([$_POST['json_productos'], $total, $metodo, $vendedor]);
    $id_factura = $conn->lastInsertId();

    $conn->commit();
    
    // Redirigir a la vista del ticket (Emitir Ticket)
    header("Location: imprimir_ticket.php?id=$id_factura");

} catch (Exception $e) {
    $conn->rollBack();
    echo "Error: " . $e->getMessage();
}