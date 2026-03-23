<?php
include("conexion.php");
session_start();

$items = json_decode($_POST['json_venta'], true);
$total = $_POST['total_pago'];
$metodo = $_POST['metodo_pago'];
$vendedor = $_SESSION['trabajador'];

if (empty($items)) {
    echo "<script>alert('El ticket está vacío'); window.history.back();</script>";
    exit();
}

// Simulamos validación de pago (Flujo Alterno)
$pago_exitoso = true; 
if ($metodo == "Tarjeta" && rand(1, 10) == 1) { // 10% de probabilidad de fallo
    $pago_exitoso = false;
}

if (!$pago_exitoso) {
    echo "<script>alert('ERROR: Pago con Tarjeta Rechazado. Intente con otro método.'); window.history.back();</script>";
    exit();
}

try {
    $conn->beginTransaction();

    // 4. Procesar pago y descontar stock
    foreach ($items as $item) {
        // Descontar stock
        $update = $conn->prepare("UPDATE productos SET stock = stock - 1 WHERE id = ?");
        $update->execute([$item['id']]);

        // Registrar en facturación/ventas
        $ins = $conn->prepare("INSERT INTO ventas (producto, total, metodo_pago, estado, vendedor, fecha) VALUES (?, ?, ?, 'Pagado', ?, NOW())");
        $ins->execute([$item['nombre'], $item['precio'], $metodo, $vendedor]);
    }

    $conn->commit();
    echo "<script>alert('Venta Procesada y Stock Actualizado'); window.location.href='panel_trabajador.php';</script>";

} catch (Exception $e) {
    $conn->rollBack();
    echo "Error en la transacción: " . $e->getMessage();
}
?>