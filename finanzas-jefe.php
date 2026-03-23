<?php
session_start();
include("conexion.php");
if (!isset($_SESSION['admin_auth'])) { header("Location: login-jefe.html"); exit(); }

// Consultamos las ventas que aún no tienen factura
$query = "SELECT * FROM ventas ORDER BY fecha DESC";
$resultado = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kaso Sekai - Facturación</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        .tabla-ventas { width: 90%; margin: 20px auto; border-collapse: collapse; background: white; }
        .tabla-ventas th, .tabla-ventas td { padding: 15px; border: 1px solid #ff2277; text-align: center; }
        .tabla-ventas th { background-color: #ff2277; color: white; }
        .btn-facturar { background: #28a745; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; }
    </style>
</head>
<body class="body">
    <header class="kaso-header">
        <img src="img/Logo.png" alt="Logo" style="height: 80px;">
        <h1>Gestión de Ventas y Facturación</h1>
    </header>

    <div class="kaso-nov">
        <h2>Selecciona las ventas para facturar</h2>
    </div>

    <form action="datos-fiscales.php" method="POST">
        <table class="tabla-ventas">
            <thead>
                <tr>
                    <th>Seleccionar</th>
                    <th>ID Venta</th>
                    <th>Producto</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><input type="checkbox" name="ventas_seleccionadas[]" value="<?php echo $row['id_venta']; ?>"></td>
                    <td>#<?php echo $row['id_venta']; ?></td>
                    <td><?php echo $row['producto_lista']; ?></td>
                    <td>$<?php echo number_format($row['total'], 2); ?></td>
                    <td><?php echo $row['fecha']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <div style="text-align: center; margin-bottom: 50px;">
            <button type="submit" class="btn-facturar">
                <i class="fa-solid fa-file-invoice-dollar"></i> Siguiente: Datos Fiscales
            </button>
        </div>
    </form>
</body>
</html>