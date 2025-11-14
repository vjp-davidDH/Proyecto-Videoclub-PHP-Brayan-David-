<?php
require_once __DIR__ . '/../app/Clases/Cliente.php';
session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Carga de datos almacenados en sesión (clientes y soportes)
$clientes = $_SESSION['clientes'] ?? [];
$soportes = $_SESSION['soportes'] ?? [];
// Comentarios generados por ChatGPT 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Panel de Administración</title>
</head>

<body>

    <!-- Muestra el nombre del administrador conectado -->
    <h2>Bienvenido, administrador <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
    <p><a href="logout.php">Cerrar sesión</a></p>

    <h3>Listado de clientes</h3>
    <ul>
        <?php foreach ($clientes as $i => $cliente): ?>
            <li>
                <?php
                // Muestra nombre del cliente y su usuario de acceso
                echo $cliente->nombre . ' (Usuario: ' . $cliente->getUser() . ')';
                ?>
                <!-- Enlace para editar este cliente usando su índice -->
                <p><a href="formUpdateCliente.php?numero=<?php echo $cliente->getNumero(); ?>">Editar cliente</a></p>
                <p>
                    <a href="removeCliente.php?numero=<?php echo $cliente->getNumero(); ?>"
                        onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                        Eliminar cliente
                    </a>
                </p>
            </li>
        <?php endforeach; ?>
        <p><a href="formCreateCliente.php">Dar de alta un nuevo cliente</a></p>
    </ul>


    <!-- Listado de soportes registrados -->
    <h3>Listado de soportes</h3>
    <ul>
        <?php foreach ($soportes as $soporte): ?>
            <li>
                <?php echo $soporte['titulo'] . ' - ' . $soporte['tipo']; ?>
            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>