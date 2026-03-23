
<?php
include("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nuevo_estado = $_POST['nuevo_estado'];

    // Preparamos la consulta para actualizar el estado
    $sql = "UPDATE producto SET estado = :estado WHERE productoID = :id";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':estado', $nuevo_estado, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirigir de vuelta a la tabla con éxito
        header("Location: index.php?mensaje=actualizado");
    } else {
        echo "Error al actualizar el estado.";
    }
}
?>