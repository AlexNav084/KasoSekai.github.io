<?php
include("conexion.php");

$id_venta = $_POST['id_venta'];
$direccion = $_POST['direccion'];
$metodo = $_POST['metodo'];

try {
    // Si la compra viene del carrito (ya existe el ID), actualizamos
    if (!empty($id_venta)) {
        $sql = "UPDATE ventas SET estado = 'Pagado', direccion_envio = ?, metodo_pago = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$direccion, $metodo, $id_venta]);
    } else {
        // Si es una compra directa desde "Consulta", insertamos como Pagado de una vez
        $sql = "INSERT INTO ventas (producto, total, direccion_envio, metodo_pago, estado, imagen) VALUES (?, ?, ?, ?, 'Pagado', 'img/logo.png')";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$_POST['producto'], $_POST['total'], $direccion, $metodo]);
    }

    echo "<script>
        alert('¡Compra Exitosa! Tu pedido ha sido registrado.');
        window.location.href = 'carrito.php';
    </script>";
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>