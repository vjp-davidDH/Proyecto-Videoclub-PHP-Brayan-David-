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
<html>
<head>
    <title>Crear Nuevo Cliente</title>
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
    </style>
</head>
<body>

    <h2>Crear Nuevo Cliente</h2>
    <p><a href="mainAdmin.php">Volver al panel de administración</a></p>

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
            <label for="nombre">Nombre del Cliente:</label>
            <input type="text" name="nombre" id="nombre" required placeholder="Ej: Juan Pérez">
        </div>

        <div class="form-group">
            <label for="numero">Número de Cliente:</label>
            <input type="number" name="numero" id="numero" required placeholder="Ej: 3" min="1">
        </div>

        <div class="form-group">
            <label for="user">Usuario de Acceso:</label>
            <input type="text" name="user" id="user" required placeholder="Ej: juan123">
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required placeholder="Mínimo 4 caracteres">
        </div>

        <div class="form-group">
            <label for="maxAlquiler">Máximo de Alquileres Concurrentes:</label>
            <input type="number" name="maxAlquiler" id="maxAlquiler" value="3" min="1" placeholder="Ej: 3">
        </div>

        <div>
            <button type="submit">Crear Cliente</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='mainAdmin.php'">Cancelar</button>
        </div>
    </form>

</body>
</html>
