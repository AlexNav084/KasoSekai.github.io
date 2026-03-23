<?php
include("conexion.php");
session_start();
date_default_timezone_set('America/Mexico_City');
if (!isset($_SESSION['trabajador'])) { header("Location: login_trabajador.php"); exit(); }

$productos = $conn->query("SELECT * FROM productos")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto de Venta - Kaso Sekai Staff</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        :root { --pink: #ff2277; --light-pink: #ffe6f0; }
        body { background: var(--light-pink); font-family: 'Segoe UI', sans-serif; margin: 0; }
        .main-grid { display: grid; grid-template-columns: 1.5fr 1fr; gap: 20px; padding: 20px; height: 90vh; }
        .card { background: white; border-radius: 15px; border: 2px solid #ffc0cb; padding: 20px; display: flex; flex-direction: column; overflow: hidden; }
        
        /* Buscador */
        .search-bar { width: 100%; padding: 12px; border: 2px solid var(--light-pink); border-radius: 10px; margin-bottom: 15px; }
        .scroll-area { overflow-y: auto; flex-grow: 1; }
        
        .prod-row { display: flex; justify-content: space-between; align-items: center; padding: 10px; border-bottom: 1px solid var(--light-pink); }
        .stock-tag { padding: 4px 8px; border-radius: 5px; font-size: 0.8rem; }
        .in-stock { background: #d4edda; color: #155724; }
        .out-stock { background: #f8d7da; color: #721c24; }

        /* Ticket */
        .ticket-box { background: #f9f9f9; border: 1px dashed #ccc; padding: 15px; flex-grow: 1; font-family: 'Courier New', monospace; }
        .total-section { font-size: 1.2rem; font-weight: bold; color: var(--pink); border-top: 2px solid var(--pink); padding-top: 10px; margin-top: 10px; }
        .btn-pay { background: var(--pink); color: white; border: none; width: 100%; padding: 15px; border-radius: 10px; font-weight: bold; cursor: pointer; margin-top: 10px; }
    </style>
</head>
<body>

<div class="main-grid">
    <div class="card">
        <h2 style="color: var(--pink);"><i class="fa-solid fa-search"></i> Consultar Catálogo</h2>
        <input type="text" id="busqueda" class="search-bar" placeholder="Buscar por nombre o categoría..." onkeyup="filtrar()">
        
        <div class="scroll-area">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="position: sticky; top: 0; background: white;">
                    <tr style="text-align: left; color: #666; font-size: 0.9rem;">
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Disponibilidad</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="tabla-prods">
                    <?php foreach($productos as $p): ?>
                    <tr class="prod-row" data-info="<?php echo strtolower($p['nombre']." ".$p['categoria']); ?>">
                        <td><strong><?php echo $p['nombre']; ?></strong><br><small><?php echo $p['categoria']; ?></small></td>
                        <td>$<?php echo $p['precio']; ?></td>
                        <td>
                            <span class="stock-tag <?php echo ($p['stock'] > 0) ? 'in-stock' : 'out-stock'; ?>">
                                <?php echo ($p['stock'] > 0) ? "En Tienda: ".$p['stock'] : "Agotado"; ?>
                            </span>
                        </td>
                        <td>
                            <?php if($p['stock'] > 0): ?>
                            <button class="btn-pay" style="padding: 5px 10px; font-size: 0.8rem;" 
                                    onclick="agregarAlTicket('<?php echo $p['nombre']; ?>', <?php echo $p['precio']; ?>, <?php echo $p['id']; ?>)">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <h2 style="color: var(--pink);"><i class="fa-solid fa-file-invoice-dollar"></i> Registrar Venta</h2>
        <div class="ticket-box" id="ticket-visual">
            <p style="text-align: center;">*** KASO SEKAI ***<br>Esperando productos...</p>
        </div>

        <div class="total-section">
            <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: #666;">
                <span>Subtotal:</span> <span id="sub-txt">$0.00</span>
            </div>
            <div style="display: flex; justify-content: space-between; font-size: 0.9rem; color: #666;">
                <span>IVA (16%):</span> <span id="iva-txt">$0.00</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 5px;">
                <span>TOTAL:</span> <span id="total-txt">$0.00</span>
            </div>
        </div>

        <form action="procesar_venta_final.php" method="POST" id="form-venta">
            <input type="hidden" name="json_productos" id="json_productos">
            <input type="hidden" name="total_pago" id="total_pago">
            
            <label style="font-size: 0.8rem; font-weight: bold;">Método de Pago:</label>
            <select name="metodo" id="metodo" required class="search-bar" style="margin-bottom: 10px;">
                <option value="Efectivo">Efectivo</option>
                <option value="Tarjeta">Tarjeta (Visa/Mastercard)</option>
                <option value="Transferencia">Transferencia</option>
            </select>

            <button type="submit" class="btn-pay">FINALIZAR E IMPRIMIR TICKET</button>
        </form>
    </div>
</div>

<script>
    let carrito = [];

    function filtrar() {
        let val = document.getElementById('busqueda').value.toLowerCase();
        document.querySelectorAll('.prod-row').forEach(row => {
            row.style.display = row.dataset.info.includes(val) ? 'table-row' : 'none';
        });
    }

    function agregarAlTicket(n, p, id) {
        carrito.push({id, n, p});
        actualizarTicket();
    }

    function actualizarTicket() {
        let html = "<p style='text-align:center;'><b>KASO SEKAI</b><br>Staff: <?php echo $_SESSION['trabajador']; ?></p><hr>";
        let sub = 0;
        carrito.forEach((i, idx) => {
            sub += i.p;
            html += `<div style="display:flex; justify-content:space-between;">
                        <span>${i.n}</span>
                        <span>$${i.p} <i class="fa-solid fa-times" onclick="borrar(${idx})" style="color:red; cursor:pointer;"></i></span>
                    </div>`;
        });
        
        let iva = sub * 0.16;
        let total = sub + iva;

        document.getElementById('ticket-visual').innerHTML = html;
        document.getElementById('sub-txt').innerText = "$" + sub.toFixed(2);
        document.getElementById('iva-txt').innerText = "$" + iva.toFixed(2);
        document.getElementById('total-txt').innerText = "$" + total.toFixed(2);
        
        document.getElementById('json_productos').value = JSON.stringify(carrito);
        document.getElementById('total_pago').value = total.toFixed(2);
    }

    function borrar(idx) {
        carrito.splice(idx, 1);
        actualizarTicket();
    }
</script>
</body>
</html>