<?php
// Configuración de la conexión a la base de datos
$host = "localhost";    // Servidor local de XAMPP
$user = "root";        // Usuario por defecto de XAMPP
$pass = "";            // Sin contraseña por defecto
$dbname = "blog_cms";  // Nombre de nuestra base de datos

// Crear la conexión usando mysqli
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar si hay error en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
