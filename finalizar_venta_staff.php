<?php
include("conexion.php");
session_start();
// 1. Ajustamos la hora local
date_default_timezone_set('America/Mexico_City');

if (!isset($_SESSION['trabajador'])) {
    header("Location: login_trabajador.php");
    exit();
}

// 2. Recibimos los datos del formulario de registrar_venta.php
$datos_recibidos = $_POST['datos_venta']; // Viene como JSON
$total_venta = $_POST['total_final'];
$metodo = $_POST['metodo'];
$vendedor = $_SESSION['trabajador'];
$fecha_hoy = date("Y-m-d H:i:s");

// Convertimos el JSON en un arreglo de PHP
$productos_comprados = json_decode($datos_recibidos, true);

if (empty($productos_comprados)) {
    echo "<script>alert('Error: No hay productos en el ticket'); window.history.back();</script>";
    exit();
}

try {
    // Iniciamos una transacción para que si algo falla, no se descuente nada
    $conn->beginTransaction();

    foreach ($productos_comprados as $item) {
        $id_p = $item['id'];
        $nombre_p = $item['nombre'];
        $precio_p = $item['precio'];

        // 3. DESCONTAR STOCK (Importante para tu inventario)
        $sql_stock = "UPDATE productos SET stock = stock - 1 WHERE id = ?";
        $stmt_stock = $conn->prepare($sql_stock);
        $stmt_stock->execute([$id_p]);

        // 4. REGISTRAR VENTA (Para facturación)
        // Usamos 'Pagado' por defecto porque es venta directa en sucursal
        $sql_venta = "INSERT INTO ventas (producto, total, metodo_pago, estado, vendedor, fecha, imagen) 
                      VALUES (?, ?, ?, 'Pagado', ?, ?, 'img/logo_venta.png')";
        $stmt_venta = $conn->prepare($sql_venta);
        $stmt_venta->execute([$nombre_p, $precio_p, $metodo, $vendedor, $fecha_hoy]);
    }

    $conn->commit(); // Confirmamos todos los cambios en la BD

    echo "<script>
            alert('¡Venta Registrada con Éxito! Stock actualizado.');
            window.location.href = 'panel_trabajador.php';
          </script>";

} catch (Exception $e) {
    $conn->rollBack(); // Si hubo error, cancelamos todo
    echo "Error al procesar la venta: " . $e->getMessage();
}
?>