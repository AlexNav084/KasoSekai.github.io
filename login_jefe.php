<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Kaso Sekai</title>
    <style>
        body { font-family: sans-serif; background-color: #fce4ec; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); width: 300px; text-align: center; }
        h2 { color: #ff4081; }
        input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background-color: #ff4081; color: white; border: none; border-radius: 6px; cursor: pointer; }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Kaso Sekai</h2>
    <form action="validar.php" method="POST">
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit">Entrar</button>
    </form>
</div>

</body>
</html>