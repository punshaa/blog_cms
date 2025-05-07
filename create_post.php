<?php
// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene y sanitiza los datos del formulario
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    
    // Procesa la imagen si se ha subido una
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        // Asegura que el directorio existe
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        // Genera un nombre único para la imagen
        $image = time() . '_' . basename($_FILES["image"]["name"]);
        $target_file = $target_dir . $image;
        
        // Verifica si es una imagen válida
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
            // Intenta mover la imagen al directorio de uploads
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // Imagen subida correctamente
            } else {
                $image = ''; // Error al subir la imagen
            }
        } else {
            $image = ''; // No es una imagen válida
        }
    }
    
    // Inserta el post en la base de datos
    $sql = "INSERT INTO posts (title, content, image) VALUES ('$title', '$content', '$image')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirige a la página principal después de crear el post
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Nuevo Post</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Contenedor principal con estilo mejorado -->
    <div class="container">
        <!-- Título centrado -->
        <h1 class="page-title">Crear Nuevo Post</h1>
        
        <!-- Formulario de creación de post con diseño mejorado -->
        <form action="create_post.php" method="POST" enctype="multipart/form-data" class="create-post-form">
            <!-- Grupo para el título -->
            <div class="form-group">
                <label for="title">Título del Post</label>
                <input type="text" id="title" name="title" required 
                       placeholder="Escribe un título atractivo para tu post"
                       class="form-control">
            </div>

            <!-- Grupo para el contenido -->
            <div class="form-group">
                <label for="content">Contenido</label>
                <textarea id="content" name="content" required 
                          placeholder="Escribe el contenido de tu post aquí..."
                          class="form-control"></textarea>
            </div>

            <!-- Grupo para la imagen -->
            <div class="form-group">
                <label for="image">Imagen (opcional)</label>
                <div class="file-upload-container">
                    <input type="file" id="image" name="image" accept="image/*" class="file-upload">
                    <label for="image" class="file-upload-label">
                        <span class="upload-icon">📷</span>
                        <span class="upload-text">Seleccionar imagen</span>
                    </label>
                </div>
                <small class="file-info">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 5MB</small>
            </div>

            <!-- Botones de acción -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">🌱 Publicar Post</button>
                <a href="index.php" class="btn-view-posts">📋 Ver Posts Existentes</a>
            </div>
        </form>
    </div>

    <!-- Script para mostrar el nombre del archivo seleccionado -->
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            if (fileName) {
                document.querySelector('.file-info').textContent = `Archivo seleccionado: ${fileName}`;
            }
        });
    </script>
</body>
</html>
