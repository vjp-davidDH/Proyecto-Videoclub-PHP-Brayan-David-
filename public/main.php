<?php
// Iniciar sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    // Si no está logueado, redirigir al login
    header("Location: index.php");
    exit();
}

// Obtener el nombre del usuario
$usuario = $_SESSION['usuario'];

// Comentarios generados por ChatGPT 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Videoclub</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="main-container">
        <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h2>

        <!-- Enlace para cerrar sesión -->
        <p><a href="logout.php" class="logout-link">Cerrar sesión</a></p>
    </div>
</body>
</html>
