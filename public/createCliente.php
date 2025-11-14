<?php
require_once __DIR__ . '/../autoload.php';
session_start();

// Verificar que el usuario sea admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Obtener datos del formulario
$nombre = $_POST['nombre'] ?? '';
$numero = $_POST['numero'] ?? '';
$user = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';
$maxAlquiler = $_POST['maxAlquiler'] ?? 3;

// Validar que todos los campos estén completos
if (empty($nombre) || empty($numero) || empty($user) || empty($password)) {
    header("Location: formCreateCliente.php?error=Todos los campos son obligatorios");
    exit();
}

// Validar que el número sea un entero positivo
if (!is_numeric($numero) || $numero <= 0) {
    header("Location: formCreateCliente.php?error=El número de cliente debe ser un valor positivo");
    exit();
}

// Validar que la contraseña tenga al menos 4 caracteres
if (strlen($password) < 4) {
    header("Location: formCreateCliente.php?error=La contraseña debe tener al menos 4 caracteres");
    exit();
}

// Validar que el usuario no exista ya
$clientes = $_SESSION['clientes'] ?? [];
foreach ($clientes as $cliente) {
    if ($cliente->getUser() === $user) {
        header("Location: formCreateCliente.php?error=El usuario ya existe en el sistema");
        exit();
    }
    if ($cliente->getNumero() == $numero) {
        header("Location: formCreateCliente.php?error=El número de cliente ya existe en el sistema");
        exit();
    }
}

// Validar que maxAlquiler sea un número positivo
if (!is_numeric($maxAlquiler) || $maxAlquiler <= 0) {
    $maxAlquiler = 3;
}

// Crear nuevo cliente usando la clase Cliente
try {
    $nuevoCliente = new Dwes\ProyectoVideoclub\Cliente(
        $nombre,
        (int)$numero,
        $user,
        $password,
        (int)$maxAlquiler
    );

    // Agregar el cliente a la sesión
    $_SESSION['clientes'][] = $nuevoCliente;

    // Redirigir al panel de administración
    header("Location: mainAdmin.php?success=Cliente creado exitosamente");
    exit();
} catch (Exception $e) {
    header("Location: formCreateCliente.php?error=Error al crear el cliente: " . $e->getMessage());
    exit();
}
?>
