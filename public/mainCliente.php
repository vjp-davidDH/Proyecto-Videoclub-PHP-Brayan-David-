<?php
session_start();

/*
 * Control de acceso:
 * Si no hay sesión de usuario o si el usuario ES admin,
 * no debe acceder al área de cliente. Se redirige al login.
 */
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] === 'admin') {
    header("Location: index.php");
    exit();
}

// Cliente actualmente autenticado
$cliente = $_SESSION['clienteActual'] ?? null;

// Si no existe el cliente en sesión, vuelve al login con un mensaje de error
if (!$cliente) {
    header("Location: index.php?error=Cliente no encontrado");
    exit();
}

// Alquileres del cliente
$alquileres = $cliente->getAlquileres();
// Comentarios generados por ChatGPT 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Área del Cliente</title>
</head>
<body>

    <!-- Saludo personalizado -->
    <h2>Bienvenido, <?php echo htmlspecialchars($cliente->nombre); ?></h2>
    <p><a href="logout.php">Cerrar sesión</a></p>

    <!-- Listado de soportes alquilados -->
    <h3>Listado de alquileres</h3>

    <?php if (!empty($alquileres)): ?>
        <ul>
            <?php foreach ($alquileres as $soporte): ?>
                <li>
                    <?php
                    // Muestra título y precio del soporte
                    echo $soporte->getTitulo() . " - " . $soporte->getPrecio();
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes soportes alquilados actualmente.</p>
    <?php endif; ?>

</body>
</html>

