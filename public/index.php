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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Videoclub</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="login-container">
        <h2>Acceso al Videoclub</h2>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error): ?>
            <div class="error">
                <p><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>

        <!-- Formulario de login -->
        <form method="post" action="login.php">
            <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
