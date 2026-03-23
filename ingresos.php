<?php
// Datos de ejemplo (Inventario de ventas para el balance)
$productos_ventas = [
    ["nombre" => "Accesorios de Naruto", "precio" => 170.00, "cantidad" => 5],
    ["nombre" => "Playera de Naruto",    "precio" => 200.00, "cantidad" => 3],
    ["nombre" => "Cosplay de Mika",      "precio" => 750.00, "cantidad" => 2],
    ["nombre" => "Figura Goku Ultra",    "precio" => 1200.00, "cantidad" => 1]
];

$total_general = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresos Totales - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #fce4ec; font-family: sans-serif; padding: 30px; }
        .contenedor-ingresos { 
            background: white; 
            max-width: 700px; 
            margin: auto; 
            padding: 30px; 
            border-radius: 15px; 
            border: 2px solid #2ecc71;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        h2 { color: #2ecc71; text-align: center; }
        
        .tabla-balance { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .tabla-balance th { background: #2ecc71; color: white; padding: 10px; }
        .tabla-balance td { padding: 12px; border-bottom: 1px solid #eee; text-align: center; }
        
        .fila-total { background: #f9f9f9; font-weight: bold; font-size: 1.2rem; }
        .btn-cierre { 
            display: block; 
            width: 100%; 
            padding: 15px; 
            background: #27ae60; 
            color: white; 
            border: none; 
            border-radius: 8px; 
            margin-top: 25px; 
            cursor: pointer; 
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-cierre:hover { background: #1e8449; }
        .btn-volver { display: inline-block; margin-bottom: 20px; color: #ff2277; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="contenedor-ingresos">
    <a href="perfil_jefe.php" class="btn-volver"><i class="fa-solid fa-arrow-left"></i> Volver al Panel</a>
    
    <h2><i class="fa-solid fa-money-bill-trend-up"></i> Reporte de Ingresos Totales</h2>
    <p style="text-align: center; color: #666;">Balance actual de ventas realizadas en Kaso Sekai</p>

    <table class="tabla-balance">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio Unit.</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos_ventas as $prod): 
                $subtotal = $prod['precio'] * $prod['cantidad'];
                $total_general += $subtotal;
            ?>
            <tr>
                <td><?php echo $prod['nombre']; ?></td>
                <td>$<?php echo number_format($prod['precio'], 2); ?></td>
                <td><?php echo $prod['cantidad']; ?></td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <?php endforeach; ?>
            
            <tr class="fila-total">
                <td colspan="3" style="text-align: right;">TOTAL INGRESOS:</td>
                <td style="color: #27ae60;">$<?php echo number_format($total_general, 2); ?></td>
            </tr>
        </tbody>
    </table>

    <button class="btn-cierre" onclick="alert('Cierre de caja guardado en la base de datos.')">
        <i class="fa-solid fa-lock"></i> Realizar Cierre de Caja Manual
    </button>
</div>

</body>
</html>