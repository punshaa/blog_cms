<?php
// Incluye el archivo de conexión a la base de datos
include 'db.php';

// Realiza la consulta SQL para obtener todos los posts ordenados por fecha de creación (más recientes primero)
$result = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <meta charset="UTF-8">  <!-- Define la codificación de caracteres -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- Hace el sitio responsive -->
    <link rel="stylesheet" href="style.css">  <!-- Enlaza la hoja de estilos -->
</head>
<body>
    <!-- Contenedor principal que centra y da estilo al contenido -->
    <div class="container">
        <h1>Posts</h1>
        <!-- Contenedor para centrar el botón de crear post -->
        <div class="create-post-container">
            <!-- Enlace para crear un nuevo post -->
            <a href="create_post.php">Crear nuevo post</a>
        </div>

        <!-- Bucle para mostrar todos los posts obtenidos de la base de datos -->
        <?php while($row = $result->fetch_assoc()): ?>
            <!-- Contenedor individual para cada post -->
            <div class="post">
                <!-- Título del post con escape HTML para seguridad -->
                <h2><?= htmlspecialchars($row['title']) ?></h2>
                <!-- Contenido del post con escape HTML y conversión de saltos de línea -->
                <p><?= nl2br(htmlspecialchars($row['content'])) ?></p>

                <!-- Verificamos si hay una imagen asociada y la mostramos -->
                <?php if (!empty($row['image'])): ?>
                    <!-- Imagen del post -->
                    <img src="uploads/<?= htmlspecialchars($row['image']) ?>" alt="Imagen del post" class="post-image">
                <?php endif; ?>

                <!-- Fecha de publicación -->
                <small>Publicado el <?= $row['created_at'] ?></small>

                <!-- Formulario para eliminar el post -->
                <form action="delete_post.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar este post?');">
                    <!-- Campo oculto que contiene el ID del post a eliminar -->
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <!-- Botón para eliminar el post -->
                    <button type="submit">🗑️ Borrar</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

