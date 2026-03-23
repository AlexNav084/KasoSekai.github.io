<?php
session_start();
include("conexion.php");

// 1. Consulta para la tabla principal
$sql = $conn->query("SELECT * FROM empleados");

// 2. Consulta para el TOTAL de dinero recaudado
$query_total = $conn->query("SELECT SUM(ventas_totales) as total_caja FROM empleados");
$dato_total = $query_total->fetch(PDO::FETCH_ASSOC);
$dinero_recaudado = $dato_total['total_caja'] ?? 0;

// 3. Consulta para el Vendedor Estrella (el que tiene más ventas)
$query_estrella = $conn->query("SELECT nombre, ventas_totales FROM empleados ORDER BY ventas_totales DESC LIMIT 1");
$vendedor_top = $query_estrella->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Empleados - Kaso Sekai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
  <style>
    .card-resumen {
      border: none;
      border-radius: 15px;
      transition: 0.3s;
    }
    .card-resumen:hover { transform: translateY(-5px); }
    .bg-kaso { background-color: #ff2277; color: white; }
  </style>
</head>
<body style="background-color: #fce4ec;">

<div class="container mt-5">
    
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card card-resumen shadow-sm p-3 bg-white text-center">
                <h6 class="text-muted text-uppercase">Total Dinero Recaudado</h6>
                <h2 class="text-success fw-bold">$<?= number_format($dinero_recaudado, 2) ?></h2>
                
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-resumen shadow-sm p-3 bg-white text-center">
                <h6 class="text-muted text-uppercase">Vendedor Estrella </h6>
                <h2 style="color: #ff2277;" class="fw-bold">
                    <?= $vendedor_top['nombre'] ?? 'Sin datos' ?>
                </h2>
                <p class="mb-0 text-muted">Ventas: $<?= number_format($vendedor_top['ventas_totales'] ?? 0, 2) ?></p>
            </div>
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 style="color: #ff2277;"><i class="fa-solid fa-users-gear"></i> Personal de Kaso Sekai</h3>
        <a href="perfil_jefe.php" class="btn btn-outline-secondary btn-sm">Volver al Panel</a>
    </div>

    <table class="table table-hover shadow-sm bg-white rounded">
        <thead class="table-dark" style="background-color: #ff2277 !important; border:none;">
            <tr>
              <th>ID</th>
              <th>Nombre del Empleado</th>
              <th>Rol / Permisos</th>
              <th>Estado</th>
              <th>Ventas Realizadas</th>
              <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $sql->fetch(PDO::FETCH_ASSOC)): ?>
            <tr>
              <td><?= $row['id'] ?></td>
              <td><strong><?= $row['nombre'] ?></strong></td>
              <td><span class="badge bg-info text-dark"><?= $row['rol'] ?></span></td>
              <td>
                  <?php if($row['estado'] == 'Activo'): ?>
                    <span class="badge bg-success">Activo</span>
                  <?php else: ?>
                    <span class="badge bg-danger">Inactivo</span>
                  <?php endif; ?>
              </td>
              <td class="text-success fw-bold">$<?= number_format($row['ventas_totales'], 2) ?></td>
              <td>
                  <a href="modificar_empleado.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen"></i></a>
                  <a href="baja_empleado.php?id=<?= $row['id'] ?>" 
                     class="btn btn-sm btn-danger" 
                     onclick="return confirmarBaja();">
                    <i class="fa-solid fa-user-minus"></i>
                  </a>
              </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="mt-4 pb-5">
        <a href="alta_empleado.php" class="btn btn-primary" style="background-color: #ff2277; border:none;">
            <i class="fa-solid fa-user-plus"></i> Crear Nuevo Usuario
        </a>
    </div>
</div>

<script>
function confirmarBaja() {
    return confirm("¿Estás seguro de que deseas eliminar a este empleado? Esta acción no se puede deshacer.");
}
</script>

</body>
</html>