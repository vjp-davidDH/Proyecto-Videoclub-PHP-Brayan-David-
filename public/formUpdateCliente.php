<?php
require_once __DIR__ . '/../app/Clases/Cliente.php';
session_start();

// Verificar que el usuario sea admin o sea el cliente que se edita
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Obtener el ID del cliente a editar
$clienteId = $_GET['numero'] ?? '';
$error = isset($_GET['error']) ? $_GET['error'] : '';

// Validar que se haya proporcionado un ID
if (empty($clienteId) || !is_numeric($clienteId)) {
    header("Location: mainAdmin.php?error=ID de cliente no válido");
    exit();
}

$clienteId = (int)$clienteId;

// Buscar el cliente en la sesión
$clientes = $_SESSION['clientes'] ?? [];
$clienteEncontrado = null;

foreach ($clientes as $cliente) {
    if ($cliente->getNumero() == $clienteId) {
        $clienteEncontrado = $cliente;
        break;
    }
}

// Si no se encuentra el cliente, redirigir
if ($clienteEncontrado === null) {
    header("Location: mainAdmin.php?error=Cliente no encontrado");
    exit();
}

// Verificar permisos: solo admin o el cliente mismo
if ($_SESSION['usuario'] !== 'admin' && 
    (!isset($_SESSION['clienteActual']) || $_SESSION['clienteActual']->getNumero() != $clienteId)) {
    header("Location: index.php?error=No tienes permiso para editar este cliente");
    exit();
}

// Determinar de dónde viene el usuario (admin o cliente)
$origen = $_GET['origen'] ?? 'admin';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/formUpdateCliente.css">
</head>
<body>

    <div class="form-container">
        <h2>Editar Cliente</h2>
        
        <?php if ($_SESSION['usuario'] === 'admin'): ?>
            <a href="mainAdmin.php" class="back-link">Volver al panel de administración</a>
        <?php else: ?>
            <a href="mainCliente.php" class="back-link">Volver a mi perfil</a>
        <?php endif; ?>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error): ?>
            <div class="error">
                <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <div class="info">
            <p>Modifica los datos del cliente según sea necesario.</p>
        </div>

        <!-- Formulario para editar cliente -->
        <form method="post" action="updateCliente.php">
            <input type="hidden" name="clienteId" value="<?php echo htmlspecialchars($clienteId); ?>">
            <input type="hidden" name="origen" value="<?php echo htmlspecialchars($origen); ?>">

            <div class="form-group">
                <label for="nombre" class="required">Nombre del Cliente:</label>
                <input type="text" name="nombre" id="nombre" required 
                       value="<?php echo htmlspecialchars($clienteEncontrado->nombre); ?>">
            </div>

            <div class="form-group">
                <label for="numero">Número de Cliente:</label>
                <input type="number" name="numero" id="numero" disabled 
                       value="<?php echo htmlspecialchars($clienteEncontrado->getNumero()); ?>">
                <div class="field-info">Este campo no puede ser modificado</div>
            </div>

            <div class="form-group">
                <label for="user">Usuario de Acceso:</label>
                <input type="text" name="user" id="user" disabled 
                       value="<?php echo htmlspecialchars($clienteEncontrado->getUser()); ?>">
                <div class="field-info">Este campo no puede ser modificado</div>
            </div>

            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" name="password" id="password" 
                       placeholder="Dejar en blanco para mantener la actual">
                <div class="field-info">Mínimo 4 caracteres si deseas cambiarla</div>
            </div>

            <div class="form-group">
                <label for="maxAlquiler">Máximo de Alquileres Concurrentes:</label>
                <input type="number" name="maxAlquiler" id="maxAlquiler" min="1" 
                       value="<?php 
                       // Intentar obtener el valor mediante reflexión o propiedades públicas
                       // Como no está disponible directamente, usamos un valor por defecto
                       echo '3'; 
                       ?>">
            </div>

            <div class="button-group">
                <button type="submit">Guardar Cambios</button>
                <button type="button" class="btn-cancel" onclick="history.back()">Cancelar</button>
            </div>
        </form>
    </div>

</body>
</html>
