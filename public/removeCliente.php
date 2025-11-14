<?php
require_once __DIR__ . '/../app/Clases/Cliente.php';
session_start();

// Verificar que el usuario sea admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Obtener el ID del cliente a eliminar
$clienteId = $_GET['numero'] ?? ''; // asegúrate de usar 'numero', igual que en el enlace

if (empty($clienteId) || !is_numeric($clienteId)) {
    header("Location: mainAdmin.php?error=ID de cliente no válido");
    exit();
}

$clienteId = (int)$clienteId;

// Buscar y eliminar el cliente **directamente en la sesión**
$clienteEncontrado = false;

foreach ($_SESSION['clientes'] as $key => $cliente) {
    if ($cliente->getNumero() == $clienteId) {
        unset($_SESSION['clientes'][$key]); // elimina el cliente directamente
        $clienteEncontrado = true;
        break;
    }
}

// Reindexar el array de sesión
if ($clienteEncontrado) {
    $_SESSION['clientes'] = array_values($_SESSION['clientes']);
    header("Location: mainAdmin.php?success=Cliente eliminado exitosamente");
} else {
    header("Location: mainAdmin.php?error=Cliente no encontrado");
}
exit();
