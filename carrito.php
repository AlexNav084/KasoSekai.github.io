<?php
include("conexion.php");
// Usamos ORDER BY 1 DESC para ordenar por la primera columna (el ID) sin importar su nombre
$query = "SELECT * FROM ventas ORDER BY 1 DESC";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Compras - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        .compra-card { 
            background: white; 
            border: 2px solid #ffc0cb; 
            border-radius: 15px; 
            margin: 15px auto; 
            padding: 15px; 
            display: flex; 
            align-items: center; 
            justify-content: space-between;
            max-width: 900px;
        }
        .info-prod { display: flex; align-items: center; gap: 20px; }
        .status-pagado { background: #28a745; color: white; padding: 8px 15px; border-radius: 20px; font-weight: bold; }
        .status-pendiente { background: #6c757d; color: white; padding: 8px 15px; border-radius: 20px; font-weight: bold; margin-right: 10px; }
        .btn-pagar { 
            background: #ff2277; 
            color: white; 
            padding: 10px 20px; 
            border-radius: 10px; 
            text-decoration: none; 
            font-weight: bold;
            display: inline-block;
        }
        .btn-pagar:hover { background: #e01b68; }
    </style>
</head>
<body style="background-color: #ffe6f0;">
    <h1 style="text-align: center; color: #333; margin-top: 20px;">Mis Compras en Anime Soul</h1>
    
    <div class="container">
        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)): 
    // TRUCO: Buscamos el nombre de la primera columna (tu ID) dinámicamente
    $nombres_columnas = array_keys($row);
    $nombre_id = $nombres_columnas[0]; 
    $valor_id = $row[$nombre_id];
?>
    <div class="compra-card">
        <div class="info-prod">
            <img src="<?php echo $row['imagen']; ?>" width="80" style="border-radius: 10px;">
            <div>
                <h3 style="margin: 0; color: #ff2277;"><?php echo $row['producto']; ?></h3>
                <p style="margin: 5px 0;">Total: <strong>$<?php echo number_format($row['total'], 2); ?></strong></p>
            </div>
        </div>
        
        <div>
            <?php if(isset($row['estado']) && $row['estado'] == 'Pagado'): ?>
                <span class="status-pagado"><i class="fa-solid fa-check"></i> PAGADO</span>
            <?php else: ?>
                <span class="status-pendiente">NO PAGADO</span>
                <a href="checkout.php?id=<?php echo $valor_id; ?>&producto=<?php echo urlencode($row['producto']); ?>&precio=<?php echo $row['total']; ?>" class="btn-pagar">
                    <i class="fa-solid fa-cash-register"></i> Pagar ahora
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endwhile; ?>
    </div>
</body>
</html>