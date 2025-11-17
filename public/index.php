<?php
// Iniciar sesión para poder usar variables de sesión
session_start();

// Si ya hay un usuario logueado, redirigir a main.php
if (isset($_SESSION['usuario'])) {
    header("Location: mainCliente.php");
    exit();
    // Comentarios generados por ChatGPT 
}

// Verificar si hay un mensaje de error para mostrar
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Videoclub</title>
</head>
<body>
    <h2>Acceso al Videoclub</h2>

    <!-- Mostrar mensaje de error si existe -->
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <!-- Formulario de login -->
    <form method="post" action="login.php">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</body>
</html>
