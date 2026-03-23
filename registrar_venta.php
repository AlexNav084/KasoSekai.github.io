<?php
include("conexion.php");
session_start();
date_default_timezone_set('America/Mexico_City');

if (!isset($_SESSION['trabajador'])) { 
    header("Location: login_trabajador.php"); 
    exit(); 
}

// Obtenemos productos con stock disponible
$productos = $conn->query("SELECT * FROM productos WHERE stock > 0")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Punto de Venta - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        .pos-container { display: flex; gap: 20px; padding: 20px; min-height: 80vh; }
        .panel-izq { flex: 2; background: white; padding: 20px; border-radius: 15px; border: 2px solid #ffc0cb; }
        .panel-der { flex: 1; background: white; padding: 20px; border-radius: 15px; border: 2px solid #ff2277; height: fit-content; }
        .producto-item { 
            display: flex; justify-content: space-between; padding: 10px; 
            border-bottom: 1px solid #ffe6f0; align-items: center; 
        }
        .btn-add { background: #ff2277; color: white; border: none; padding: 8px 15px; border-radius: 10px; cursor: pointer; font-weight: bold; }
        .ticket-item { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 0.9rem; }
        .total-box { border-top: 2px solid #ff2277; margin-top: 15px; padding-top: 10px; font-size: 1.3rem; font-weight: bold; color: #ff2277; }
    </style>
</head>
<body style="background-color: #ffe6f0;">

    <div class="pos-container">
        <div class="panel-izq">
            <h2 style="color: #ff2277;"><i class="fa-solid fa-magnifying-glass"></i> Buscador de Productos</h2>
            <input type="text" id="inputBusqueda" onkeyup="filtrarProductos()" placeholder="Escribe el nombre del producto..." 
                   style="width: 100%; padding: 15px; border-radius: 10px; border: 2px solid #ffc0cb; margin-bottom: 20px; font-size: 1rem;">
            
            <div id="listaProductos">
                <?php foreach($productos as $p): ?>
                <div class="producto-item" data-nombre="<?php echo strtolower($p['nombre']); ?>">
                    <div>
                        <strong><?php echo $p['nombre']; ?></strong><br>
                        <small style="color: #666;">Stock: <?php echo $p['stock']; ?></small>
                    </div>
                    <div>
                        <span style="margin-right: 15px; font-weight: bold;">$<?php echo number_format($p['precio'], 2); ?></span>
                        <button class="btn-add" onclick="agregarAlTicket('<?php echo $p['nombre']; ?>', <?php echo $p['precio']; ?>, <?php echo $p['id']; ?>)">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="panel-der">
            <h3 style="text-align: center; border-bottom: 2px dashed #ffc0cb; padding-bottom: 10px;">Resumen de Venta</h3>
            <div id="contenedorTicket" style="min-height: 150px; padding: 10px 0;">
                <p style="text-align: center; color: #999;">El ticket está vacío</p>
            </div>

            <div class="total-box">
                Total: $<span id="txtTotal">0.00</span>
            </div>

            <form action="finalizar_venta_staff.php" method="POST" style="margin-top: 20px;">
                <input type="hidden" name="datos_venta" id="hiddenDatos">
                <input type="hidden" name="total_final" id="hiddenTotal">

                <label style="font-weight: bold; display: block; margin-bottom: 5px;">Método de Pago:</label>
                <select name="metodo" required style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #ff2277; margin-bottom: 20px;">
                    <option value="Efectivo">Efectivo</option>
                    <option value="Tarjeta">Tarjeta de Crédito/Débito</option>
                    <option value="Transferencia">Transferencia</option>
                </select>

                <button type="submit" class="btn-add" style="width: 100%; padding: 15px; font-size: 1.1rem;">
                    <i class="fa-solid fa-cart-check"></i> FINALIZAR VENTA
                </button>
            </form>
        </div>
    </div>

    <script>
        let ticket = [];

        // FUNCIÓN DEL BUSCADOR: Filtra mientras escribes
        function filtrarProductos() {
            let filtro = document.getElementById('inputBusqueda').value.toLowerCase();
            let items = document.querySelectorAll('.producto-item');
            
            items.forEach(item => {
                let nombre = item.getAttribute('data-nombre');
                if (nombre.includes(filtro)) {
                    item.style.display = "flex";
                } else {
                    item.style.display = "none";
                }
            });
        }

        // FUNCIÓN AGREGAR: Actualiza el monto y la lista
        function agregarAlTicket(nombre, precio, id) {
            ticket.push({ id, nombre, precio });
            renderizarTicket();
        }

        function quitarDelTicket(index) {
            ticket.splice(index, 1);
            renderizarTicket();
        }

        function renderizarTicket() {
            const contenedor = document.getElementById('contenedorTicket');
            const txtTotal = document.getElementById('txtTotal');
            const hiddenDatos = document.getElementById('hiddenDatos');
            const hiddenTotal = document.getElementById('hiddenTotal');

            if (ticket.length === 0) {
                contenedor.innerHTML = '<p style="text-align: center; color: #999;">El ticket está vacío</p>';
                txtTotal.innerText = "0.00";
                return;
            }

            let html = "";
            let suma = 0;

            ticket.forEach((prod, index) => {
                suma += prod.precio;
                html += `
                    <div class="ticket-item">
                        <span>${prod.nombre}</span>
                        <span>$${prod.precio.toFixed(2)} <i class="fa-solid fa-circle-xmark" onclick="quitarDelTicket(${index})" style="color:red; cursor:pointer; margin-left:5px;"></i></span>
                    </div>`;
            });

            contenedor.innerHTML = html;
            txtTotal.innerText = suma.toFixed(2);
            
            // Actualizamos los campos ocultos para el PHP
            hiddenTotal.value = suma.toFixed(2);
            hiddenDatos.value = JSON.stringify(ticket);
        }
    </script>
</body>
</html>