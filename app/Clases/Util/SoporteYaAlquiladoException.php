<?php
// Incluimmos el autoload para cargar automaticamente las clases
require_once __DIR__ . "/../autoload.php";

// Importamos la clases desde el namaspace
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;

// try catch me ha ayudado ChatGPT
// de esta manera manejamos los errores de manera controlada
try {
    // Lanzamos la excepcion, simulando unn error "Soporte ya alquilado"
    throw new SoporteYaAlquiladoException("El soporte ya esta alquilado");
} catch (SoporteYaAlquiladoException $e) {
    // Capturamos la excepcion lanzada y mostramos el mensaje
    echo "Error: " . $e->getMessage();
}

?>