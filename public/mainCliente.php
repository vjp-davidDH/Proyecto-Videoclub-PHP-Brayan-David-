<?php
namespace Dwes\ProyectoVideoclub;

// Cargar todas las clases necesarias
require_once __DIR__ . '/../app/Clases/Cliente.php';
require_once __DIR__ . '/../app/Clases/Soporte.php';
require_once __DIR__ . '/../app/Clases/Dvd.php';
require_once __DIR__ . '/../app/Clases/CintaVideo.php';
require_once __DIR__ . '/../app/Clases/Juego.php';
require_once __DIR__ . '/../app/Clases/Videoclub.php';

session_start();

use Dwes\ProyectoVideoclub\Dvd;
use Dwes\ProyectoVideoclub\CintaVideo;
use Dwes\ProyectoVideoclub\Juego;

// Control de acceso: solo usuarios no-admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] === 'admin') {
    header("Location: index.php");
    exit();
}

// Cliente actualmente autenticado
$cliente = $_SESSION['clienteActual'] ?? null;

// Si no existe el cliente, volver al login
if (!$cliente) {
    header("Location: index.php?error=Cliente no encontrado");
    exit();
}

// ⚡ Inicializar soportes de prueba si el cliente no tiene ninguno
if (empty($cliente->getAlquileres())) {
    $cliente->añadirSoporte(new Dvd("El Padrino", 10, "ES,EN", "16:9"));
    $cliente->añadirSoporte(new CintaVideo("Titanic", 8, 195));
    $cliente->añadirSoporte(new Juego("Mario Kart", 15, "Nintendo Switch", 1, 4));

    // Guardar nuevamente el cliente en sesión
    $_SESSION['clienteActual'] = $cliente;
}

// Obtener alquileres
$alquileres = $cliente->getAlquileres();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Área del Cliente</title>
</head>
<body>

    <h2>Bienvenido, <?php echo htmlspecialchars($cliente->nombre); ?></h2>
    <p><a href="logout.php">Cerrar sesión</a></p>

    <h3>Listado de soportes alquilados</h3>

    <?php if (!empty($alquileres)): ?>
        <ul>
            <?php foreach ($alquileres as $soporte): ?>
                <li>
                    <?php
                        echo htmlspecialchars($soporte->getTitulo()) . " - €" . number_format($soporte->getPrecio(), 2);
                    ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No tienes soportes alquilados actualmente.</p>
    <?php endif; ?>

</body>
</html>
