<?php
include("conexion.php");

$sql = $conn->query("SELECT * FROM producto WHERE estado = 'Active'");

// Datos informativos (mantenidos)
$query_max = $conn->query("SELECT nombre, stock FROM producto ORDER BY stock DESC LIMIT 1");
$prod_max = $query_max->fetch(PDO::FETCH_ASSOC);

$query_min = $conn->query("SELECT nombre, stock FROM producto ORDER BY stock ASC LIMIT 1");
$prod_min = $query_min->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Trabajador - Kaso Sekai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #FFC0CB !important; }
        .kaso-header { background-color: #ff78db; padding: 15px 0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px; position: relative; }
        .kaso-header img { width: 100px; display: block; margin: 0 auto; }
        .kaso-header h1 { color: #ff2277; font-weight: bold; font-size: 1.8rem; }
        .container-tabla { background-color: rgba(255, 255, 255, 0.95); padding: 25px; border-radius: 15px; }
        .ticket-venta { background: white; border-radius: 15px; padding: 20px; border: 2px dashed #ff2277; min-height: 450px; }
        .btn-seleccionar { background-color: #ff2277; color: white; border-radius: 50px; border: none; padding: 5px 12px; font-size: 0.85rem; }
        .btn-seleccionar:disabled { background-color: #ccc; cursor: not-allowed; }
        .btn-borrar { background-color: #dc3545; color: white; border-radius: 50px; border: none; padding: 8px; width: 100%; font-weight: bold; margin-bottom: 10px; }
    </style>
</head>
<body>

<header class="kaso-header">
    <a href="iniciar_sesion.html" class="btn btn-danger btn-sm" style="position: absolute; top: 20px; right: 20px; border-radius: 50px;">
        <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
    </a>
    <img src="img/Logo.png" alt="Logo">
    <h1>Kaso Sekai - Punto de Venta</h1>
</header>



<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="container-tabla shadow table-responsive">
                <h3 class="mb-4 text-center" style="color:#ff2277">Inventario de Productos</h3>
                <table class="table table-hover align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Stock Disponible</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="fila-1">
                            <td>Accesorios de Naruto</td>
                            <td>$170.00</td>
                            <td><span id="stock-1">15</span> pz</td>
                            <td><button class="btn btn-seleccionar" id="btn-1" onclick="seleccionar(1, 'Accesorios de Naruto', 170.00)">Seleccionar</button></td>
                        </tr>
                        <tr id="fila-2">
                            <td>Playera de Naruto</td>
                            <td>$200.00</td>
                            <td><span id="stock-2">10</span> pz</td>
                            <td><button class="btn btn-seleccionar" id="btn-2" onclick="seleccionar(2, 'Playera de Naruto', 200.00)">Seleccionar</button></td>
                        </tr>
                        <tr id="fila-3">
                            <td>Cosplay de Mika</td>
                            <td>$750.00</td>
                            <td><span id="stock-3">3</span> pz</td>
                            <td><button class="btn btn-seleccionar" id="btn-3" onclick="seleccionar(3, 'Cosplay de Mika', 750.00)">Seleccionar</button></td>
                        </tr>
                        <tr id="fila-4">
                            <td>Taza one-punch</td>
                            <td>$300.00</td>
                            <td><span id="stock-4">20</span> pz</td>
                            <td><button class="btn btn-seleccionar" id="btn-4" onclick="seleccionar(4, 'Taza one-punch', 300.00)">Seleccionar</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-4">
    <div class="ticket-venta shadow">
        <h4 class="text-center" style="color: #ff2277;"><i class="fa-solid fa-receipt"></i> Carrito</h4>
        <button class="btn-borrar" onclick="limpiarCarrito()">
            <i class="fa-solid fa-trash-can"></i> Borrar Todo
        </button>
        
        <form action="generar_ticket.php" method="POST" id="form-venta">
            <div id="lista-compra" style="min-height: 150px; border: 1px solid #eee; padding: 10px; border-radius: 10px; margin-bottom: 15px;">
                <p class="text-muted text-center small">Carrito vacío</p>
            </div>
            
            <div id="inputs-ocultos"></div>

            <div class="d-flex justify-content-between mb-1">
                <span>Subtotal:</span> <strong id="subtotal">$0.00</strong>
            </div>
            <div class="d-flex justify-content-between mb-1">
                <span>IVA (16%):</span> <strong id="iva">$0.00</strong>
            </div>
            <div class="d-flex justify-content-between fs-4 mt-2" style="color: #ff2277;">
                <span>TOTAL:</span> <strong id="total">$0.00</strong>
            </div>
            
            <label class="mt-3 fw-bold small">PAGO:</label>
            <select name="metodo_pago" class="form-select mb-3">
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta</option>
            </select>
            
            <button type="submit" class="btn btn-dark w-100 fw-bold py-2">IMPRIMIR TICKET</button>
        </form>
    </div>
</div>

    <div class="text-center my-5">
        <div style="background: white; display: inline-block; padding: 20px; border-radius: 15px; border: 2px solid #ff2277;">
            <h2 style="color: #ff2277;">Entrada Registrada</h2>
            <p>Tu hora de entrada hoy: <strong><?php echo date("H:i a"); ?></strong></p>
            <p>¡Que tengas una excelente jornada en Kaso Sekai! 🌸</p>
        </div>
    </div>
</div>

<script>
    let subtotal = 0;
    let carrito = [];

    function seleccionar(id, nombre, precio) {
    let stockElem = document.getElementById('stock-' + id);
    let stockActual = parseInt(stockElem.innerText);

    if (stockActual > 0) {
        stockActual--;
        stockElem.innerText = stockActual;
        if (stockActual === 0) document.getElementById('btn-' + id).disabled = true;

        if (subtotal === 0) document.getElementById('lista-compra').innerHTML = '';
        
        carrito.push({ id, nombre, precio });
        subtotal += precio;

        // Mostrar en pantalla
        const item = document.createElement('div');
        item.className = 'd-flex justify-content-between border-bottom py-1 small';
        item.innerHTML = `<span>${nombre}</span> <strong>$${precio.toFixed(2)}</strong>`;
        document.getElementById('lista-compra').appendChild(item);

        // Crear input oculto para enviar al ticket (formato: Nombre|Precio)
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'ventas[]';
        input.value = `${nombre}|${precio}`;
        document.getElementById('inputs-ocultos').appendChild(input);

        actualizarTotales();
    }
}

    function limpiarCarrito() {
        // Devolver stocks
        carrito.forEach(item => {
            let stockElem = document.getElementById('stock-' + item.id);
            let stockActual = parseInt(stockElem.innerText);
            stockElem.innerText = stockActual + 1;
            document.getElementById('btn-' + item.id).disabled = false;
        });

        // Resetear variables
        subtotal = 0;
        carrito = [];
        document.getElementById('lista-compra').innerHTML = '<p class="text-muted text-center small">Carrito vacío</p>';
        actualizarTotales();
    }

    function finalizarVenta() {
        if(subtotal > 0) {
            alert("✅ Venta procesada exitosamente por $" + document.getElementById('total').innerText);
            // Aquí podrías enviar los datos a un PHP para el descuento real en la DB
            location.reload();
        } else {
            alert("❌ Agregue productos al carrito.");
        }
    }
</script>

</body>
</html>