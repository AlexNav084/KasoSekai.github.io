<?php
include("conexion.php");

// Procesar el formulario si se envió
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre         = $_POST['nombre'] ?? '';
    $precio         = $_POST['precio'] ?? 0;
    $stock          = $_POST['stock'] ?? 0;
    $nombre_cliente = $_POST['nombre_cliente'] ?? '';
    $estado         = $_POST['estado'] ?? '';
    $fecha          = $_POST['fecha'] ?? date('Y-m-d');
    $imagen         = $_POST['imagen'] ?? '';

    try {
        $sql = "INSERT INTO producto (nombre, precio, stock, nombre_cliente, estado, fecha, imagen)
                VALUES ('$nombre', '$precio', '$stock', '$nombre_cliente', '$estado', '$fecha', '$imagen')";
        
        $conn->exec($sql);
        echo "<script>alert('¡Producto registrado!'); window.location.href='gerente-cuenta.php';</script>";
        exit();
    } catch(PDOException $e) {
        echo "<div class='alert alert-danger'>Error al registrar: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Producto - Kaso Sekai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #FFC0CB !important; }
        .kaso-header { background-color: #ff78db; padding: 15px 0; text-align: center; color: white; margin-bottom: 20px; }
        .card-alta { border-radius: 20px; border: none; }
        label { color: #ff2277; font-weight: bold; }
    </style>
</head>
<body>

<header class="kaso-header">
    <h1>Kaso Sekai</h1>
</header>

<div class="container d-flex justify-content-center">
    <div class="card card-alta p-4 shadow-lg" style="width: 500px;">
        <h3 class="text-center mb-4" style="color: #ff2277;">📦 Nuevo Producto</h3>
        
        <form action="altaproducto.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nombre del Producto</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Precio ($)</label>
                    <input type="number" step="0.01" name="precio" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Nombre del Cliente</label>
                <input type="text" name="nombre_cliente" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" name="fecha" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Nombre de Imagen (ej: naruto.jpg)</label>
                <input type="text" name="imagen" class="form-control">
            </div>

            <button type="submit" class="btn w-100" style="background-color: #ff2277; color: white;">Guardar Registro</button>
            <a href="gerente-cuenta.php" class="btn btn-link w-100 mt-2 text-secondary">Volver</a>
        </form>
    </div>
</div>
</body>
</html>