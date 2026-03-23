<?php
// Recibimos los datos por la URL (GET)
$producto = isset($_GET['producto']) ? $_GET['producto'] : "Producto Desconocido";
$precio = isset($_GET['precio']) ? $_GET['precio'] : "0.00";
$imagen = isset($_GET['img']) ? $_GET['img'] : "img/Logo.png";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        .checkout-container { max-width: 800px; margin: 50px auto; background: white; padding: 30px; border-radius: 20px; border: 3px solid #ffc0cb; display: flex; gap: 30px; }
        .resumen-compra { flex: 1; border-right: 1px solid #eee; padding-right: 20px; }
        .formulario-pago { flex: 1; }
        .img-checkout { width: 100%; border-radius: 15px; margin-bottom: 15px; }
        .btn-finalizar { background: #ff2277; color: white; border: none; padding: 15px; width: 100%; border-radius: 10px; font-weight: bold; cursor: pointer; }
        input { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ffc0cb; border-radius: 8px; }
    </style>
</head>
<body style="background-color: #ffe6f0;">

    <div class="checkout-container">
        <div class="resumen-compra">
            <h2 style="color: #ff2277;">Tu Pedido</h2>
            <img src="<?php echo $imagen; ?>" class="img-checkout">
            <h3><?php echo $producto; ?></h3>
            <p style="font-size: 1.5rem; color: #ff2277; font-weight: bold;">$<?php echo $precio; ?></p>
            <p><i class="fa-solid fa-truck-fast"></i> Envío gratis incluido</p>
        </div>

        <div class="formulario-pago">
            <h2 style="color: #333;">Datos de Pago</h2>
            <form action="procesar_pago_cliente.php" method="POST">
                <input type="hidden" name="producto_nombre" value="<?php echo $producto; ?>">
                <input type="hidden" name="monto" value="<?php echo $precio; ?>">

                <label>Nombre en la Tarjeta</label>
                <input type="text" placeholder="Juan Perez" required>

                <label>Número de Tarjeta</label>
                <input type="text" placeholder="**** **** **** 1234" maxlength="16" required>

                <div style="display:flex; gap:10px;">
                    <div>
                        <label>Vencimiento</label>
                        <input type="text" placeholder="MM/AA" maxlength="5">
                    </div>
                    <div>
                        <label>CVV</label>
                        <input type="text" placeholder="123" maxlength="3">
                    </div>
                </div>

                <button type="submit" class="btn-finalizar">PAGAR AHORA</button>
            </form>
            <p style="font-size: 0.8rem; text-align: center; margin-top: 10px; color: #888;">Pago seguro procesado por Kaso Sekai</p>
        </div>
    </div>

</body>
</html>