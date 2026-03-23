<?php
include("conexion.php");
$id = $_GET['id'];
$venta = $conn->query("SELECT * FROM ventas WHERE id_venta = $id")->fetch(PDO::FETCH_ASSOC);
$prods = json_decode($venta['producto_lista'], true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket #<?php echo $id; ?></title>
    <style>
        .ticket { width: 80mm; padding: 5mm; font-family: 'Courier New'; font-size: 12px; }
        .text-center { text-align: center; }
        .btn-print { background: #ff2277; color: white; padding: 10px; border: none; cursor: pointer; margin-top: 20px; }
        @media print { .btn-print { display: none; } }
    </style>
</head>
<body>
    <div class="ticket">
        <h2 class="text-center">KASO SEKAI</h2>
        <p class="text-center">Ticket de Venta: #<?php echo $id; ?><br>Fecha: <?php echo $venta['fecha']; ?></p>
        <hr>
        <?php foreach($prods as $p): ?>
            <div style="display: flex; justify-content: space-between;">
                <span><?php echo $p['n']; ?></span>
                <span>$<?php echo $p['p']; ?></span>
            </div>
        <?php endforeach; ?>
        <hr>
        <p style="text-align: right;"><strong>TOTAL: $<?php echo $venta['total']; ?></strong></p>
        <p class="text-center">¡Gracias por tu compra!<br>Atendido por: <?php echo $venta['vendedor']; ?></p>
        
        <button onclick="window.print()" class="btn-print">Imprimir Ticket (Impresora Térmica)</button>
        <a href="punto_venta.php" class="btn-print" style="background: #666; text-decoration: none;">Nueva Venta</a>
    </div>
</body>
</html>