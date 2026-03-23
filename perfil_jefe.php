
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Control - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <script src="https://kit.fontawesome.com/5e528ab127.js" crossorigin="anonymous"></script>
    <style>
        .kaso-header { background-color: #ff2277; display: flex; align-items: center; padding: 10px 20px; }
        .kaso-header h1 { color: black; margin-left: 20px; }
        .modulo-card {
            background: white;
            border: 2px solid #ff2277;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            transition: 0.3s;
        }
        .btn-carrito-link{
             text-decoration: none;
        }
        .modulo-card:hover { transform: scale(1.05); background: #fff0f5; }
        .grid-admin {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            padding: 40px;
        }
    </style>
</head>
<body class="body">
    <header class="kaso-header">
        <img src="img/Logo.png" alt="Logo" style="height: 80px;">
        <div class="header-content">
            <h1>Bienvenido, </h1>
            <nav>
                <a href="perfil_jefe.php"> <i class="fa-solid fa-gauge"></i> Dashboard</a>
                <a href="index.html"> <i class="fa-solid fa-power-off"></i> Cerrar Turno</a>
            </nav>
        </div>
    </header>

    <div class="kaso-nov">
        <h2>Módulos del Sistema</h2>
        <p>Identidad Validada: Módulos sensibles desbloqueados <i class="fa-solid fa-lock-open"></i></p>
    </div>
        <div class="modulo-card" style="border-color: gold;">
         <a href="reportes_financieros.php" class="btn-carrito-link" >   <i class="fa-solid fa-chart-line fa-3x" style="color: green;"></i>
            <h3>Finanzas y Ventas</h3>
            <p>Reportes de ventas y facturas</p>
            Ver Balances</a>
        </div>
             <div class="modulo-card" style="border-color: gold;">
          <a href="ingresos.php" class="btn-carrito-link" >  <i class="fa-solid fa-chart-line fa-3x" style="color: green;"></i>
            <h3>Ingresos</h3>
            <p>Reportes de ingresos totales</p>
            Ver Calculos</a>
        </div>

        <div class="modulo-card" style="border-color: gold;">
           <a href="gestion-usuarios.php" class="btn-carrito-link" > <i class="fa-solid fa-users-gear fa-3x" style="color: #333;"></i>
            <h3>Control de Usuarios</h3>
            <p>Gestionar permisos y empleados</p>
            Configurar</a>
        </div>
    </div>

    <footer style="text-align: center; margin-top: 50px;">
        <p>Kaso Sekai - Panel Maestro de Seguridad</p>
    </footer>
</body>
</html>