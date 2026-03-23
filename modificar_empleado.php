<?php
include("conexion.php");
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM empleados WHERE id='$id'");
$user = $res->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Modificar Empleado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
  <div class="card mx-auto shadow p-4 rounded-4" style="max-width:500px">
    <h4 class="text-center text-primary mb-3">✏️ Editar Perfil</h4>
    <form action="procesar_modificacion.php" method="post">
      <input type="hidden" name="id" value="<?= $user['id'] ?>">
      
      <label>Nombre:</label>
      <input type="text" name="nombre" class="form-control mb-2" value="<?= $user['nombre'] ?>" required>
      
      <label>Rol / Permisos:</label>
      <select name="rol" class="form-select mb-2">
          <option value="Vendedor" <?= $user['rol'] == 'Vendedor' ? 'selected' : '' ?>>Vendedor</option>
          <option value="Almacenista" <?= $user['rol'] == 'Almacenista' ? 'selected' : '' ?>>Almacenista</option>
          <option value="Administrador" <?= $user['rol'] == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
      </select>

      <label>Estado de Cuenta:</label>
      <select name="estado" class="form-select mb-2">
          <option value="Activo" <?= $user['estado'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
          <option value="Inactivo" <?= $user['estado'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo (Baja)</option>
      </select>

      <button class="btn btn-success w-100 mt-3">Guardar Cambios</button>
    </form>
  </div>
</div>
</body>
</html>