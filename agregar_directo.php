<?php
include("conexion.php");

// 1. Recoger datos
$producto = isset($_GET['producto']) ? $_GET['producto'] : 'Producto';
$precio_sucio = isset($_GET['precio']) ? $_GET['precio'] : '0.00';
$precio = str_replace(['$', ','], '', $precio_sucio);
$imagen = isset($_GET['img']) ? $_GET['img'] : 'img/default.jpg';
$email = "cliente@gmail.com"; 
$metodo = "Pendiente";
$estado = "En sucursal";

try {
    // 2. Insertar en la base de datos
    $sql = "INSERT INTO ventas (cliente_email, producto, imagen, total, metodo_pago, estado) 
            VALUES (:email, :producto, :imagen, :total, :metodo, :estado)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':producto', $producto);
    $stmt->bindParam(':imagen', $imagen);
    $stmt->bindParam(':total', $precio);
    $stmt->bindParam(':metodo', $metodo);
    $stmt->bindParam(':estado', $estado);
    
    $stmt->execute();

    // 3. MENSAJE DE ÉXITO Y REGRESO (Aquí está el cambio clave)
    echo "<script>
        alert('¡Tu producto se guardó correctamente!');
        window.history.back(); 
    </script>";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>