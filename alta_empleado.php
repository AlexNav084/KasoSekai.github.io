
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Nuevo Empleado - Kaso Sekai</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark bg-opacity-75 d-flex align-items-center vh-100">
<div class="container">
  <div class="card shadow-lg p-4 mx-auto" style="width:450px; border-top: 5px solid #ff2277;">
    <h3 class="text-center mb-4">Registro de Personal</h3>
    <form action="procesar_alta.php" method="post">
      <div class="mb-3">
        <label class="form-label">Nombre Completo</label>
        <input type="text" name="nombre" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Rol en el Sistema</label>
        <select name="rol" class="form-select">
            <option value="Vendedor">Vendedor</option>
            <option value="Almacenista">Almacenista</option>
            <option value="Administrador">Administrador</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Ventas Iniciales</label>
        <input type="number" step="0.01" name="ventas" class="form-control" value="0.00">
      </div>
      <button class="btn btn-primary w-100" style="background-color: #ff2277; border:none;">Guardar Empleado</button>
    </form>
  </div>
</div>
</body>
</html>