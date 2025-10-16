<?php
// Incluimmos el autoload para cargar automaticamente las clases
require_once __DIR__ . "/../autoload.php";

// Importamos la clases desde el namaspace
use Dwes\ProyectoVideoclub\Util\VideoclubException;

// try catch me ha ayudado ChatGPT
// de esta manera manejamos los errores de manera controlada
try {
    // Lanzamos la excepcion, simulando unn error "Se ha producido un error en el videoclub"
    throw new VideoclubException("Se ha producido un error en el videoclub");
} catch (VideoclubException $e) {
    // Capturamos la excepcion lanzada y mostramos el mensaje
    echo "Error: " . $e->getMessage();
}

?>