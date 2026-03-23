<?php
session_start();
if (!isset($_POST['ventas_seleccionadas'])) {
    echo "<script>alert('Por favor, selecciona al menos una venta'); window.history.back();</script>";
    exit();
}
$ids = implode(", ", $_POST['ventas_seleccionadas']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Datos Fiscales - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <style>
        .form-fiscal { max-width: 500px; margin: 40px auto; background: white; padding: 30px; border-radius: 15px; border: 2px solid #ff2277; }
        .form-fiscal input, .form-fiscal textarea { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: 1px solid #ccc; }
        label { font-weight: bold; color: #ff2277; }
    </style>
</head>
<body class="body">
    <div class="form-fiscal">
        <h2><i class="fa-solid fa-address-card"></i> Datos Fiscales del Cliente</h2>
        <p>Facturando ventas ID: <strong><?php echo $ids; ?></strong></p>
        <hr>
        <form action="generar_factura.php" method="POST">
            <input type="hidden" name="ids_ventas" value="<?php echo $ids; ?>">

            <label>Nombre o Razón Social:</label>
            <input type="text" name="razon_social" placeholder="Ej. Juan Pérez o Empresa S.A." required>

            <label>RFC / NIT / Tax ID:</label>
            <input type="text" name="rfc" placeholder="Registro Federal de Contribuyentes" required>

            <label>Correo Electrónico para envío:</label>
            <input type="email" name="email_fiscal" placeholder="correo@ejemplo.com" required>

            <label>Dirección Fiscal Completa:</label>
            <textarea name="direccion" rows="3" placeholder="Calle, Número, Colonia, CP..." required></textarea>

            <label>Uso de CFDI (Opcional):</label>
            <input type="text" name="uso_cfdi" placeholder="Ej. Gastos en general">

            <button type="submit" class="btn-carrito-link" style="width: 100%; border: none; cursor: pointer;">
                Generar Documento Fiscal
            </button>
        </form>
    </div>
</body>
</html>