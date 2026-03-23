<?php
include("conexion.php");

$sql = $conn->query("SELECT * FROM producto");

$query_max = $conn->query("SELECT nombre, stock FROM producto ORDER BY stock DESC LIMIT 1");
$prod_max = $query_max->fetch(PDO::FETCH_ASSOC);

$query_min = $conn->query("SELECT nombre, stock FROM producto ORDER BY stock ASC LIMIT 1");
$prod_min = $query_min->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gerente - Kaso Sekai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        body { background-color: #FFC0CB !important; }
        .kaso-header { background-color: #ff78db; padding: 15px 0; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px; position: relative; }
        .kaso-header img { width: 100px; height: auto; margin: 0 auto; display: block; }
        .kaso-header h1 { color: #ff2277; font-weight: bold; font-size: 1.8rem; }
        .container-tabla { background-color: rgba(255, 255, 255, 0.95); padding: 25px; border-radius: 15px; }
        .card-stock { border: none; border-radius: 12px; }
        /* Estilo para el botón de cerrar sesión */
        .btn-logout { position: absolute; top: 20px; right: 20px; border-radius: 50px; font-weight: bold; }
    </style>
</head>
<body>
<header class="kaso-header">
    <a href="iniciar_sesion.html" class="btn btn-danger btn-sm btn-logout shadow-sm">
        <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
    </a>

    <a href="gerente-cuenta.php"><img src="img/Logo.png" alt="Logo"></a>
    <h1>Kaso Sekai</h1>
</header>

<div class="container mb-4">
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card card-stock shadow-sm p-3 border-start border-4 border-primary">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="text-muted mb-0 small fw-bold">MAYOR STOCK</h6>
                        <h5 class="mb-0"><?= $prod_max['nombre'] ?? 'N/A' ?></h5>
                        <span class="badge bg-primary"><?= $prod_max['stock'] ?? 0 ?> pz</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-stock shadow-sm p-3 border-start border-4 border-danger">
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <h6 class="text-muted mb-0 small fw-bold">MENOR STOCK</h6>
                        <h5 class="mb-0"><?= $prod_min['nombre'] ?? 'N/A' ?></h5>
                        <span class="badge bg-danger"><?= $prod_min['stock'] ?? 0 ?> pz</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container container-tabla table-responsive">
    <h3 class="mb-4 text-center" style="color:#ff2277">Inventario Global</h3>
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $sql->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
                <td>#<?= $row['productoID'] ?></td>
                <td><?= $row['nombre'] ?></td>
                <td>$<?= number_format($row['precio'], 2) ?></td>
                <td class="<?= ($row['stock'] < 5) ? 'text-danger fw-bold' : '' ?>"><?= $row['stock'] ?> pz</td>
                <td><?= $row['nombre_cliente'] ?? 'N/A' ?></td>
                <td><span class="badge <?= ($row['estado']=='Activo')?'bg-success':'bg-secondary' ?>"><?= $row['estado'] ?></span></td>
                <td><img src="imagenes/<?= $row['imagen'] ?>" width="40" class="rounded"></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center gap-3 mt-4">
        <a href="altaproducto.php" class="btn btn-primary px-4">Agregar</a>
        <a href="modificar_producto_vista.html" class="btn btn-warning px-4">Modificar</a>
        <a href="bajaproducto.html" class="btn btn-danger px-4">Eliminar</a>
    </div>
</div>
</body>
</html>