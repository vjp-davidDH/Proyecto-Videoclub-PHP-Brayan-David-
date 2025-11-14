<?php
require_once __DIR__ . '/../autoload.php';
session_start();

// Verificar que el usuario sea admin o sea el cliente que se edita
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Obtener datos del formulario
$clienteId = $_POST['clienteId'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$password = $_POST['password'] ?? '';
$maxAlquiler = $_POST['maxAlquiler'] ?? 3;
$origen = $_POST['origen'] ?? 'admin';

// Validar que se haya proporcionado un ID
if (empty($clienteId) || !is_numeric($clienteId)) {
    header("Location: mainAdmin.php?error=ID de cliente no válido");
    exit();
}

$clienteId = (int)$clienteId;

// Validar que el nombre no esté vacío
if (empty($nombre)) {
    header("Location: formUpdateCliente.php?id=$clienteId&origen=$origen&error=El nombre del cliente es obligatorio");
    exit();
}

// Validar que maxAlquiler sea un número positivo
if (!is_numeric($maxAlquiler) || $maxAlquiler <= 0) {
    $maxAlquiler = 3;
}

// Si se proporciona una nueva contraseña, validar su longitud
if (!empty($password) && strlen($password) < 4) {
    header("Location: formUpdateCliente.php?id=$clienteId&origen=$origen&error=La contraseña debe tener al menos 4 caracteres");
    exit();
}

// Verificar permisos: solo admin o el cliente mismo
if ($_SESSION['usuario'] !== 'admin' && 
    (!isset($_SESSION['clienteActual']) || $_SESSION['clienteActual']->getNumero() != $clienteId)) {
    header("Location: index.php?error=No tienes permiso para editar este cliente");
    exit();
}

// Buscar el cliente en la sesión
$clientes = $_SESSION['clientes'] ?? [];
$clienteEncontrado = false;

foreach ($clientes as $key => $cliente) {
    if ($cliente->getNumero() == $clienteId) {
        // Actualizar el nombre
        $cliente->nombre = $nombre;

        // Actualizar la contraseña si se proporcionó una nueva
        if (!empty($password)) {
            // Usar reflexión para actualizar la propiedad privada password
            $reflection = new ReflectionClass($cliente);
            $passwordProperty = $reflection->getProperty('password');
            $passwordProperty->setAccessible(true);
            $passwordProperty->setValue($cliente, $password);
        }

        // Actualizar maxAlquilerConcurrente si es posible
        $reflection = new ReflectionClass($cliente);
        $maxProperty = $reflection->getProperty('maxAlquilerConcurrente');
        $maxProperty->setAccessible(true);
        $maxProperty->setValue($cliente, (int)$maxAlquiler);

        // Actualizar en la sesión
        $_SESSION['clientes'][$key] = $cliente;

        // Si el cliente actual es el que se está editando, actualizar también su sesión
        if (isset($_SESSION['clienteActual']) && $_SESSION['clienteActual']->getNumero() == $clienteId) {
            $_SESSION['clienteActual'] = $cliente;
        }

        $clienteEncontrado = true;
        break;
    }
}

// Si no se encuentra el cliente, redirigir
if (!$clienteEncontrado) {
    header("Location: mainAdmin.php?error=Cliente no encontrado");
    exit();
}

// Redirigir según de dónde vino el usuario
if ($origen === 'cliente') {
    header("Location: mainCliente.php?success=Datos actualizados exitosamente");
} else {
    header("Location: mainAdmin.php?success=Cliente actualizado exitosamente");
}
exit();
?>
