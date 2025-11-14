<?php
namespace Dwes\ProyectoVideoclub;

// Cargar clases necesarias
require_once __DIR__ . '/../app/Clases/Cliente.php';
require_once __DIR__ . '/../app/Clases/Soporte.php';
require_once __DIR__ . '/../app/Clases/Dvd.php';
require_once __DIR__ . '/../app/Clases/CintaVideo.php';
require_once __DIR__ . '/../app/Clases/Juego.php';

session_start();

// Datos de login
$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

// Usuarios válidos de ejemplo
$usuarios_validos = [
    'admin' => 'admin',
    'usuario' => 'usuario'
];

// Verificar usuario y contraseña
if (isset($usuarios_validos[$usuario]) && $usuarios_validos[$usuario] === $password) {

    $_SESSION['usuario'] = $usuario;

    if ($usuario === 'admin') {
        // Datos de soportes (solo para referencia, no se usan directamente)
        $_SESSION['soportes'] = [
            ['id' => 101, 'titulo' => 'El Padrino', 'tipo' => 'DVD'],
            ['id' => 102, 'titulo' => 'Super Mario Bros', 'tipo' => 'Juego'],
            ['id' => 103, 'titulo' => 'Titanic', 'tipo' => 'Cinta de video']
        ];

        header("Location: mainAdmin.php");
        exit();

    } else {
        $_SESSION['clienteActual'] = $cliente;
        header("Location: mainCliente.php");
        exit();
    }

} else {
    // Usuario o contraseña incorrectos
    header("Location: index.php?error=Usuario o contraseña incorrectos");
    exit();
}
