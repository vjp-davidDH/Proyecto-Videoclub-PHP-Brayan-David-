<?php
require_once __DIR__ . "/../autoload.php";

use Dwes\ProyectoVideoclub\Cliente;
use Dwes\ProyectoVideoclub\CintaVideo;
use Dwes\ProyectoVideoclub\Util\SoporteYaAlquiladoException;
use Dwes\ProyectoVideoclub\Util\CupoSuperadoException;

// Creamos un cliente y un suporte
$cliente = new Cliente ("Batman", 1);
$cinta = new CintaVideo("El Caballero Oscuro", 20, 10);z

// El try me Ayudo ChatGPT
try {
    // Alquilamos el soporte al cliente
    $cliente->alquilar($cinta);
    // Intentamos alquilar el mismo soporte de nuevo (debería lanzar una excepción)
    $cliente->alquilar($cinta);
} catch (SoporteYaAlquiladoException $e) {
    echo "Excepción capturada: " . $e->getMessage() . "\n";
} catch (CupoSuperadoException $e) {
    echo "Excepción capturada: " . $e->getMessage() . "\n";
}
?>