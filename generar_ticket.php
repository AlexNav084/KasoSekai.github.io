<?php
// Recibimos el arreglo de productos (Nombre|Precio)
$ventas_seleccionadas = $_POST['ventas'] ?? [];
$metodo_pago = $_POST['metodo_pago'] ?? 'No especificado';

$subtotal_general = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Venta - Kaso Sekai</title>
    <style>
        body {
            background-color: #fce4ec;
            font-family: 'Courier New', Courier, monospace;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .ticket {
            background: white;
            width: 300px;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .ticket h2 { text-align: center; color: #ff2277; margin: 0; font-size: 22px; }
        .ticket p { font-size: 13px; margin: 4px 0; }
        .hr { border-top: 1px dashed #333; margin: 10px 0; }
        
        .linea-producto { 
            display: flex; 
            justify-content: space-between; 
            margin: 5px 0; 
            font-size: 12px;
        }
        .seccion-final {
            margin-top: 10px;
            padding-top: 10px;
            text-align: right;
            font-size: 14px;
        }
        .total-bold {
            font-size: 18px;
            font-weight: bold;
            color: #ff2277;
        }
        .btn-acciones {
            margin-top: 20px;
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 20px;
            font-family: sans-serif;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            border: none;
        }
        .btn-volver { background-color: #ff2277; color: white; }
        .btn-imprimir { background-color: #333; color: white; }

        @media print {
            .btn-acciones { display: none; }
            body { background-color: white; padding: 0; }
            .ticket { box-shadow: none; border: none; }
        }
    </style>
</head>
<body>

    <div class="ticket">
        <h2>KASO SEKAI</h2>
        <p style="text-align:center;">Mundo Virtual Anime</p>
        <div class="hr"></div>

        <p><strong>FECHA:</strong> <?php echo date("d/m/Y H:i"); ?></p>
        <p><strong>PAGO:</strong> <?php echo htmlspecialchars($metodo_pago); ?></p>
        
        <div class="hr"></div>
        <p><strong>PRODUCTOS:</strong></p>

        <?php 
        if(!empty($ventas_seleccionadas)){
            foreach($ventas_seleccionadas as $venta){
                $partes = explode('|', $venta);
                $nombre = $partes[0];
                $precio = (float)$partes[1];
                $subtotal_general += $precio;
                
                echo "<div class='linea-producto'>";
                echo "<span>$nombre</span>";
                echo "<span>$" . number_format($precio, 2) . "</span>";
                echo "</div>";
            }
        }
        
        $iva = $subtotal_general * 0.16;
        $total = $subtotal_general + $iva;
        ?>

        <div class="hr"></div>
        
        <div class="seccion-final">
            <p>Subtotal: $<?php echo number_format($subtotal_general, 2); ?></p>
            <p>IVA (16%): $<?php echo number_format($iva, 2); ?></p>
            <p class="total-bold">TOTAL: $<?php echo number_format($total, 2); ?></p>
        </div>

        <div class="hr"></div>
        <p style="text-align:center; font-size:11px;">¡Gracias por tu compra! ✨</p>
        <p style="text-align:center; font-size:10px;">Kaso Sekai - Trabajador</p>
    </div>

    <div class="btn-acciones">
        <a href="panel_trabajador.php" class="btn btn-volver">Nueva Venta</a>
        <button onclick="window.print();" class="btn btn-imprimir">Imprimir Ticket</button>
    </div>

</body>
</html>