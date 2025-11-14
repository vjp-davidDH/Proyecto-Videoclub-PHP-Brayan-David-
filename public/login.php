<?php
session_start();

$usuario = $_POST['usuario'] ?? '';
$password = $_POST['password'] ?? '';

$usuarios_validos = [
    'admin' => 'admin',
    'usuario' => 'usuario'
];

if (isset($usuarios_validos[$usuario]) && $usuarios_validos[$usuario] === $password) {
    $_SESSION['usuario'] = $usuario;

    if ($usuario === 'admin') {
        // Cargar datos de prueba para admin
        $_SESSION['clientes'] = [
            new Dwes\ProyectoVideoclub\Cliente("Carlos Pérez", 1, "carlos", "1234"),
            new Dwes\ProyectoVideoclub\Cliente("Lucía Gómez", 2, "lucia", "5678")
        ];

        $_SESSION['soportes'] = [
            ['id' => 101, 'titulo' => 'El Padrino', 'tipo' => 'DVD'],
            ['id' => 102, 'titulo' => 'Super Mario Bros', 'tipo' => 'Juego'],
            ['id' => 103, 'titulo' => 'Titanic', 'tipo' => 'Cinta de video']
        ];

        header("Location: mainAdmin.php");
        exit();
    } else {
        // Buscar si el usuario coincide con algún cliente
        foreach ($_SESSION['clientes'] as $cliente) {
            if ($cliente->getUser() === $usuario && $cliente->getPassword() === $password) {
                $_SESSION['clienteActual'] = $cliente;
                header("Location: mainCliente.php");
                exit();
            }
        }

        // Si no coincide con ningún cliente
        header("Location: index.php?error=Usuario no encontrado");
        exit();
    }
} else {
    header("Location: index.php?error=Usuario o contraseña incorrectos");
    exit();
}
// Comentarios generados por ChatGPT 
?>
