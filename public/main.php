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
<html>
<head>
    <title>Bienvenido al Videoclub</title>
</head>
<body>
    <h2>Bienvenido, <?php echo htmlspecialchars($usuario); ?>!</h2>

    <!-- Enlace para cerrar sesión -->
    <p><a href="logout.php">Cerrar sesión</a></p>
</body>
</html>
