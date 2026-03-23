<?php
include("conexion.php");
session_start();
// Ajustamos la zona horaria para registros de auditoría si fuera necesario
date_default_timezone_set('America/Mexico_City');

// Seguridad: Solo personal autorizado
if (!isset($_SESSION['trabajador'])) { 
    header("Location: login_trabajador.php"); 
    exit(); 
}

// Obtenemos todos los productos para la tabla
$query = "SELECT * FROM productos ORDER BY nombre ASC";
$productos = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Inventario - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        .inventory-container { padding: 30px; max-width: 1000px; margin: 0 auto; background: white; border-radius: 20px; border: 3px solid #ffc0cb; margin-top: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #ff2277; color: white; padding: 12px; text-align: left; }
        td { padding: 12px; border-bottom: 1px solid #ffe6f0; }
        .stock-input { width: 60px; padding: 5px; border: 2px solid #ffc0cb; border-radius: 5px; text-align: center; font-weight: bold; }
        .btn-update { background: #28a745; color: white; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer; }
        .low-stock { color: red; font-weight: bold; }
        .header-inv { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #ff2277; padding-bottom: 10px; }
    </style>
</head>
<body style="background-color: #ffe6f0;">

    <div class="inventory-container">
        <div class="header-inv">
            <h2 style="color: #ff2277;"><i class="fa-solid fa-boxes-stacked"></i> Control de Stock</h2>
            <a href="panel_trabajador.php" style="text-decoration: none; color: #666;"><i class="fa-solid fa-circle-left"></i> Volver al Panel</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Stock Actual</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $p): ?>
                <tr>
                    <td>
                        <strong><?php echo $p['nombre']; ?></strong>
                    </td>
                    <td>$<?php echo number_format($p['precio'], 2); ?></td>
                    <td>
                        <form action="actualizar_stock.php" method="POST" style="display: flex; align-items: center; gap: 10px;">
                            <input type="hidden" name="id_prod" value="<?php echo $p['id']; ?>">
                            <input type="number" name="nuevo_stock" value="<?php echo $p['stock']; ?>" class="stock-input">
                            <span class="<?php echo ($p['stock'] <= 3) ? 'low-stock' : ''; ?>">
                                <?php echo ($p['stock'] <= 3) ? '<i class="fa-solid fa-triangle-exclamation"></i> Bajo' : ''; ?>
                            </span>
                    </td>
                    <td>
                            <button type="submit" class="btn-update">
                                <i class="fa-solid fa-rotate"></i> Actualizar
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>