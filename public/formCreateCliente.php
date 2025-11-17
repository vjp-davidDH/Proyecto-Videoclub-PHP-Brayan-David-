<?php
session_start();

// Verificar que el usuario sea admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Obtener el mensaje de error si existe
$error = isset($_GET['error']) ? $_GET['error'] : '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Cliente</title>
    <link rel="stylesheet" href="css/formCreateCliente.css">
</head>
<body>

    <div class="form-container">
        <h2>Crear Nuevo Cliente</h2>
        <a href="mainAdmin.php" class="back-link">Volver al panel de administración</a>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error): ?>
            <div class="error">
                <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="info">
            <p>Complete el formulario para agregar un nuevo cliente al sistema.</p>
        </div>

        <!-- Formulario para crear cliente -->
        <form method="post" action="createCliente.php">
            <div class="form-group">
                <label for="nombre" class="required">Nombre del Cliente:</label>
                <input type="text" name="nombre" id="nombre" required placeholder="Ej: Juan Pérez">
            </div>

            <div class="form-group">
                <label for="numero" class="required">Número de Cliente:</label>
                <input type="number" name="numero" id="numero" required placeholder="Ej: 3" min="1">
            </div>

            <div class="form-group">
                <label for="user" class="required">Usuario de Acceso:</label>
                <input type="text" name="user" id="user" required placeholder="Ej: juan123">
            </div>

            <div class="form-group">
                <label for="password" class="required">Contraseña:</label>
                <input type="password" name="password" id="password" required placeholder="Mínimo 4 caracteres">
            </div>

            <div class="form-group">
                <label for="maxAlquiler">Máximo de Alquileres Concurrentes:</label>
                <input type="number" name="maxAlquiler" id="maxAlquiler" value="3" min="1" placeholder="Ej: 3">
            </div>

            <div class="button-group">
                <button type="submit">Crear Cliente</button>
                <button type="button" class="btn-cancel" onclick="window.location.href='mainAdmin.php'">Cancelar</button>
            </div>
        </form>
    </div>

</body>
</html>
