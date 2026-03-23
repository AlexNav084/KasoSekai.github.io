<?php

// Recibimos los datos fiscales
$rfc = $_POST['rfc'] ?? '---';
$direccion = $_POST['direccion'] ?? '---';
$email = $_POST['email'] ?? '---';

// Recibimos el arreglo de ventas seleccionadas
$ventas_seleccionadas = $_POST['ventas'] ?? [];
$total_factura = 0;
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
            padding: 40px;
        }
        .ticket {
            background: white;
            width: 350px;
            padding: 25px;
            border: 1px solid #ddd;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        .ticket h2 { text-align: center; color: #ff2277; margin: 0; }
        .ticket p { font-size: 14px; margin: 5px 0; }
        .hr { border-top: 1px dashed #333; margin: 15px 0; }
        
        .linea-producto { 
            display: flex; 
            justify-content: space-between; 
            margin: 8px 0; 
            font-size: 13px;
        }
        .total-seccion {
            border-top: 2px solid #000;
            margin-top: 15px;
            padding-top: 10px;
            text-align: right;
            font-size: 18px;
            font-weight: bold;
        }
        .btn-volver {
            margin-top: 30px;
            background-color: #ff2277;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 25px;
            font-family: sans-serif;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-volver:hover { background-color: #d81b60; }
    </style>
</head>
<body>

    <div class="ticket">
        <h2>KASO SEKAI</h2>
        <p style="text-align:center;">Mundo Virtual Anime</p>
        <div class="hr"></div>

        <p><strong>DATOS FISCALES:</strong></p>
        <p>RFC: <?php echo htmlspecialchars($rfc); ?></p>
        <p>DIR: <?php echo htmlspecialchars($direccion); ?></p>
        <p>EMAIL: <?php echo htmlspecialchars($email); ?></p>
        
        <div class="hr"></div>
        <p><strong>PRODUCTOS:</strong></p>

        <?php 
        if(!empty($ventas_seleccionadas)){
            foreach($ventas_seleccionadas as $venta){
                // Separamos "Nombre|Precio"
                $partes = explode('|', $venta);
                $nombre = $partes[0];
                $precio = (float)$partes[1];
                $total_factura += $precio;
                
                echo "<div class='linea-producto'>";
                echo "<span>$nombre</span>";
                echo "<span>$" . number_format($precio, 2) . "</span>";
                echo "</div>";
            }
        } else {
            echo "<p>No se seleccionaron productos.</p>";
        }
        ?>

        <div class="total-seccion">
            TOTAL: $<?php echo number_format($total_factura, 2); ?>
        </div>

        <div class="hr"></div>
        <p style="text-align:center; font-size:11px;">¡Gracias por tu compra, Jefe!</p>
        <p style="text-align:center; font-size:10px;"><?php echo date("d/m/Y H:i:s"); ?></p>
    </div>

    <a href="perfil_jefe.php" class="btn-volver">Volver al Perfil</a>

</body>
</html>