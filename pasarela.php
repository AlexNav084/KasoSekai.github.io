<?php
// Recibimos los datos enviados desde checkout.php
$id_venta = $_POST['id_venta'] ?? ''; // ID único de la base de datos
$producto = $_POST['producto'] ?? 'Producto';
$total    = $_POST['total']    ?? '0.00';
$direccion = $_POST['direccion'] ?? '';
$metodo   = $_POST['metodo']   ?? 'Tarjeta';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasarela de Pago - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        body { 
            background-color: #FFC0CB; /* Color rosa característico */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .pasarela-card {
            background: white;
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 420px;
        }
        h2 { color: #ff2277; text-align: center; margin-bottom: 25px; }
        
        /* Diseño de la tarjeta visual */
        .tarjeta-grafica {
            background: linear-gradient(45deg, #ff2277, #ff78db);
            color: white;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 8px 20px rgba(255, 34, 119, 0.3);
            position: relative;
            overflow: hidden;
        }
        .chip {
            width: 45px;
            height: 35px;
            background: #ffd700;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .numero-tarjeta {
            font-size: 1.4rem;
            letter-spacing: 4px;
            margin-bottom: 15px;
            display: block;
        }
        .info-baja {
            display: flex;
            justify-content: space-between;
            font-size: 0.8rem;
            text-transform: uppercase;
        }

        /* Formulario */
        .form-pago input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 2px solid #ffe6f0;
            border-radius: 10px;
            box-sizing: border-box;
            transition: 0.3s;
        }
        .form-pago input:focus {
            border-color: #ff2277;
            outline: none;
        }
        .fila-doble { display: flex; gap: 10px; }
        
        .btn-pagar {
            width: 100%;
            background: #ff2277;
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-pagar:hover {
            background: #e01b68;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="pasarela-card">
        <h2>Paso Final: Pago</h2>

        <div class="tarjeta-grafica">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div class="chip"></div>
                <i class="fa-brands fa-cc-visa fa-3x"></i>
            </div>
            <span class="numero-tarjeta" id="card-display">**** **** **** ****</span>
            <div class="info-baja">
                <div>
                    <span>Titular</span><br>
                    <strong id="name-display">Nombre Apellido</strong>
                </div>
                <div>
                    <span>Vence</span><br>
                    <strong>12/29</strong>
                </div>
            </div>
        </div>

        <form action="procesar_pago.php" method="POST" class="form-pago">
            <input type="hidden" name="id_venta" value="<?php echo $id_venta; ?>">
            <input type="hidden" name="producto" value="<?php echo $producto; ?>">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <input type="hidden" name="direccion" value="<?php echo $direccion; ?>">
            <input type="hidden" name="metodo" value="<?php echo $metodo; ?>">

            <input type="text" placeholder="Nombre en la tarjeta" required 
                   oninput="document.getElementById('name-display').innerText = this.value || 'Nombre Apellido'">
            
            <input type="text" placeholder="Número de Tarjeta (16 dígitos)" maxlength="16" required
                   oninput="document.getElementById('card-display').innerText = this.value || '**** **** **** ****'">

            <div class="fila-doble">
                <input type="text" placeholder="MM/AA" maxlength="5" required>
                <input type="password" placeholder="CVV" maxlength="3" required>
            </div>

            <button type="submit" class="btn-pagar">
                Confirmar Pago de $<?php echo number_format($total, 2); ?>
            </button>
        </form>
        
        <p style="text-align: center; margin-top: 15px;">
            <a href="carrito.php" style="color: #666; font-size: 0.8rem; text-decoration: none;">Cancelar Transacción</a>
        </p>
    </div>

</body>
</html>