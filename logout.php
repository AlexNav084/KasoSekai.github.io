<?php
session_start();
session_destroy(); // Borra la sesión del trabajador
header("Location: login_trabajador.php"); // Lo manda de regreso al login
exit();
?>