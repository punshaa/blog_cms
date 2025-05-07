<?php
// Incluir la configuración de la base de datos
include 'db.php';

// Verificar si se recibió un ID por POST
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Preparar la consulta SQL para eliminar el post
    // Usamos consultas preparadas para prevenir SQL injection
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);  // 'i' indica que es un número entero
    $stmt->execute();
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();

// Redireccionar de vuelta a la página principal
header("Location: index.php");
exit;
?>
