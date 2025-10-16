<?php
// Incluimmos el autoload para cargar automaticamente las clases
require_once __DIR__ . "/../autoload.php";

// Importamos la clases desde el namaspace
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;

// try catch me ha ayudado ChatGPT
// de esta manera manejamos los errores de manera controlada
try {
    // Lanzamos la excepcion, simulando unn error "El cupo de alquileres a sido superado"
    throw new CupoSuperadoException("El cupo de alquileres a sido superado");
} catch (CupoSuperadoException $e) {
    // Capturamos la excepcion lanzada y mostramos el mensaje
    echo "Error: " . $e->getMessage();
}

?>