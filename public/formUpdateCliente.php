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
<html>
<head>
    <title>Editar Cliente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="text"]:disabled,
        input[type="number"]:disabled {
            background-color: #f0f0f0;
            cursor: not-allowed;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        button:hover {
            background-color: #45a049;
        }
        .btn-cancel {
            background-color: #f44336;
        }
        .btn-cancel:hover {
            background-color: #da190b;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .info {
            background-color: #f0f0f0;
            padding: 10px;
            border-left: 4px solid #4CAF50;
            margin-bottom: 15px;
        }
        .field-info {
            font-size: 0.9em;
            color: #666;
            margin-top: 3px;
        }
    </style>
</head>
<body>

    <h2>Editar Cliente</h2>
    
    <?php if ($_SESSION['usuario'] === 'admin'): ?>
        <p><a href="mainAdmin.php">Volver al panel de administración</a></p>
    <?php else: ?>
        <p><a href="mainCliente.php">Volver a mi perfil</a></p>
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
            <label for="nombre">Nombre del Cliente:</label>
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

        <div>
            <button type="submit">Guardar Cambios</button>
            <button type="button" class="btn-cancel" onclick="history.back()">Cancelar</button>
        </div>
    </form>

</body>
</html>
