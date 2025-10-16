<?php
// Incluimmos el autoload para cargar automaticamente las clases
require_once __DIR__ . "/../autoload.php";

// Importamos la clases desde el namaspace
use Dwes\ProyectoVideoclub\Util\SoporteNoEncontradoException;

// try catch me ha ayudado ChatGPT
// de esta manera manejamos los errores de manera controlada
try {
    // Lanzamos la excepcion, simulando unn error "Soporte no se ha encontrado"
    throw new SoporteNoEncontradoException("El soporte no se ha encontrado");
} catch (SoporteNoEncontradoException $e) {
    // Capturamos la excepcion lanzada y mostramos el mensaje
    echo "Error: " . $e->getMessage();
}

?>