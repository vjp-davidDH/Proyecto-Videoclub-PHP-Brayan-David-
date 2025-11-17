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
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/mainAdmin.css">
</head>

<body>

    <div class="admin-container">
        <!-- Muestra el nombre del administrador conectado -->
        <h2>Bienvenido, administrador <?php echo htmlspecialchars($_SESSION['usuario']); ?></h2>
        <p><a href="logout.php" class="logout-link">Cerrar sesión</a></p>

        <h3>Listado de clientes</h3>
        <ul class="client-list">
            <?php foreach ($clientes as $i => $cliente): ?>
                <li>
                    <div class="client-info">
                        <?php
                        // Muestra nombre del cliente y su usuario de acceso
                        echo $cliente->nombre . ' (Usuario: ' . $cliente->getUser() . ')';
                        ?>
                    </div>
                    <div class="client-actions">
                        <!-- Enlace para editar este cliente usando su índice -->
                        <a href="formUpdateCliente.php?numero=<?php echo $cliente->getNumero(); ?>" class="btn-edit">Editar cliente</a>
                        <a href="removeCliente.php?numero=<?php echo $cliente->getNumero(); ?>"
                            class="btn-delete"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');">
                            Eliminar cliente
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
        <p><a href="formCreateCliente.php" class="btn-create">Dar de alta un nuevo cliente</a></p>

        <!-- Listado de soportes registrados -->
        <h3>Listado de soportes</h3>
        <ul class="support-list">
            <?php foreach ($soportes as $soporte): ?>
                <li>
                    <?php echo $soporte['titulo'] . ' - ' . $soporte['tipo']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</body>

</html>
