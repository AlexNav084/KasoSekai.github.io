<?php
include("conexion.php");
session_start();

if (!isset($_SESSION['trabajador'])) { exit("Acceso denegado"); }

$id = $_POST['id_prod'];
$stock = $_POST['nuevo_stock'];

if (isset($id) && isset($stock)) {
    try {
        $sql = "UPDATE productos SET stock = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$stock, $id]);

        echo "<script>
                alert('Stock actualizado correctamente');
                window.location.href = 'inventario.php';
              </script>";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>