
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finanzas - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #fce4ec; font-family: sans-serif; }
        .container-finanzas { padding: 40px; max-width: 800px; margin: auto; }
        
        .venta-item { 
            background: white; 
            border: 1px solid #ddd; 
            padding: 15px; 
            margin-bottom: 10px; 
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .venta-item input[type="checkbox"] { transform: scale(1.5); cursor: pointer; }
        .detalles-venta { flex-grow: 1; }
        #nomdetail { font-weight: bold; color: #ff2277; margin: 0; }
        #precdetail { color: #2ecc71; font-weight: bold; margin: 0; }
        
        .centro-boton { display: flex; justify-content: center; margin: 25px 0; }

        #formulario-fiscal { 
            display: none; 
            background: #fff0f5; 
            padding: 20px; 
            border: 2px dashed #ff2277; 
            border-radius: 12px;
            margin-top: 20px;
        }

        .btn-facturar { 
            background: #2ecc71; 
            color: white; 
            padding: 15px 30px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-size: 1.1rem;
            font-weight: bold;
            transition: 0.3s;
        }
        .btn-facturar:hover { background: #27ae60; transform: scale(1.05); }

        .btn-final {
            display: block;
            margin: 20px auto 0 auto;
            background: #ff2277;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container-finanzas">
    <h2><i class="fa-solid fa-chart-line"></i> Control de Ventas Realizadas</h2>
    <p>Selecciona las ventas para generar la factura:</p>

    <form action="procesar_factura.php" method="POST">

        <div class="lista-ventas">
            <div class="venta-item">
                <input type="checkbox" name="ventas[]" class="check-venta" value="Taza One-Punch|100.00">
                <div class="detalles-venta">
                    <p id="nomdetail">Taza One-Punch</p>
                    <p>Diferentes colores y diseños - Cerámica</p>
                    <p id="precdetail">$100.00</p>
                </div>
            </div>

            <div class="venta-item">
                <input type="checkbox" name="ventas[]" class="check-venta" value="Figura Naruto|250.00">
                <div class="detalles-venta">
                    <p id="nomdetail">Figura Naruto</p>
                    <p>Material PVC - Coleccionable</p>
                    <p id="precdetail">$250.00</p>
                </div>
            </div>

            <div class="venta-item">
                <input type="checkbox" name="ventas[]" class="check-venta" value="Figura de Goku|450.00">
                <div class="detalles-venta">
                    <p id="nomdetail">Figura de Goku</p>
                    <p>Edición Especial Super Saiyan</p>
                    <p id="precdetail">$450.00</p>
                </div>
            </div>
        </div>

        <div class="centro-boton">
            <button type="button" class="btn-facturar" onclick="mostrarFormulario()">Siguiente: Datos Fiscales</button>
        </div>

        <div id="formulario-fiscal">
            <h3><i class="fa-solid fa-file-invoice"></i> Datos Fiscales del Cliente</h3>
            
            <label>RFC / NIT:</label><br>
            <input type="text" name="rfc" placeholder="Ej: ABC123456XYZ" required style="width:100%; padding:8px; margin: 10px 0;"><br>
            
            <label>Dirección Fiscal:</label><br>
            <input type="text" name="direccion" placeholder="Calle, Número y Colonia" required style="width:100%; padding:8px; margin: 10px 0;"><br>
            
            <label>Correo Electrónico:</label><br>
            <input type="email" name="email" placeholder="cliente@correo.com" required style="width:100%; padding:8px; margin: 10px 0;"><br>
            
            <button type="submit" class="btn-final">Finalizar Facturación</button>
        </div>

    </form>
</div>

<script>
    function mostrarFormulario() {
        const seleccionados = document.querySelectorAll('.check-venta:checked');
        if (seleccionados.length > 0) {
            document.getElementById('formulario-fiscal').style.display = 'block';
            window.scrollTo({
                top: document.body.scrollHeight,
                behavior: 'smooth'
            });
        } else {
            alert("Por favor, selecciona al menos una venta para continuar.");
        }
    }
</script>

</body>
</html>