<?php
// Incluir la configuración de la base de datos
include 'db.php';

// Obtener los datos del formulario
$title = $_POST['title'];
$content = $_POST['content'];

// Manejar la imagen si se subió una
$image_name = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Ruta de destino
    $target_dir = "uploads/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    // Mover la imagen al directorio "uploads"
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
}

// Preparar la consulta SQL para insertar el nuevo post (incluyendo imagen)
$stmt = $conn->prepare("INSERT INTO posts (title, content, image) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $content, $image_name);  // 'sss' indica tres strings
$stmt->execute();

// Cerrar la consulta y la conexión
$stmt->close();
$conn->close();

// Redireccionar a la página principal
header("Location: index.php");
?>
