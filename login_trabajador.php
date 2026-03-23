<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Staff - Kaso Sekai</title>
    <link rel="stylesheet" href="css/style_index.css">
    <style>
        body { background-color: #ffe6f0; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 40px; border-radius: 20px; border: 3px solid #ffc0cb; box-shadow: 0 10px 20px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        h2 { color: #ff2277; margin-bottom: 25px; }
        input { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid #ffc0cb; border-radius: 10px; box-sizing: border-box; }
        .btn-entrar { background: #ff2277; color: white; border: none; padding: 15px; width: 100%; border-radius: 10px; font-weight: bold; cursor: pointer; font-size: 16px; }
        .btn-entrar:hover { background: #e01b68; }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="img/Logo.png" width="100" alt="Logo">
        <h2>Panel de Trabajador</h2>
        <form action="validar_trabajador.php" method="POST">
            <input type="text" name="usuario" placeholder="Usuario de Staff" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" class="btn-entrar">Iniciar Jornada</button>
        </form>
        <p><a href="index.html" style="color: #666; text-decoration: none; font-size: 12px;">Volver a la tienda</a></p>
    </div>
</body>
</html>