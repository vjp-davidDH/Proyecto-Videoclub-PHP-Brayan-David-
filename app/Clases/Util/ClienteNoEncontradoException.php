<?php
// Incluimmos el autoload para cargar automaticamente las clases
require_once __DIR__ . "/../autoload.php";

// Importamos la clases desde el namaspace
use Dwes\ProyectoVideoclub\Util\ClienteNoEncontradoException;

// de esta manera manejamos los errores de manera controlada
try {
    // Lanzamos la excepcion, simulando unn error "El cliente no se ha encontrado"
    throw new ClienteNoEncontradoException("El cliente no se ha encontrado");
} catch (ClienteNoEncontradoException $e) {
    // Capturamos la excepcion lanzada y mostramos el mensaje
    echo "Error: " . $e->getMessage();
}

?>