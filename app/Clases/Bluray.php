<?php
namespace Dwes\ProyectoVideoclub;

// require_once __DIR__ . '/../../Interfaces/Resumible.php';
// Autoload handles it ideally, but other files include Resumible. I'll rely on Autoload or inconsistent require.
// Other files have require, let's look at Dvd.php: require_once __DIR__ . '/../../Interfaces/Resumible.php';
// I'll add it for consistency.

require_once __DIR__ . '/../../Interfaces/Resumible.php';

/**
 * Bluray class
 */
class Bluray extends Soporte
{
    private $duracion;
    private $is4k;

    public function __construct($titulo, $precio, $duracion, $is4k)
    {
        parent::__construct($titulo, $precio);
        $this->duracion = $duracion;
        $this->is4k = $is4k;
    }

    public function muestraResumen(): string
    {
        $mensaje = "<br>Película en Bluray";
        $mensaje .= "<br>Título: " . $this->getTitulo();
        $mensaje .= "<br>Duración: " . $this->duracion . " min";
        $mensaje .= "<br>Resolución: " . ($this->is4k ? "4K" : "HD");
        $mensaje .= "<br>Precio: " . $this->getPrecio() . " €";

        echo $mensaje;
        return $mensaje;
    }
}
