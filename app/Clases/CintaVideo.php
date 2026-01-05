<?php
namespace Dwes\ProyectoVideoclub;

require_once __DIR__ . '/../../Interfaces/Resumible.php';

/**
 * CintaVideo v0.331
 */

// Clase que representa una cinta de vídeo (hereda de Soporte)
class CintaVideo extends Soporte
{

    private $duracion; // duración en minutos

    // Constructor: inicializa título, número, precio y duración
    public function __construct($titulo, $precio, $duracion)
    {
        parent::__construct($titulo, $precio); // llamamos al constructor de la clase padre
        $this->duracion = $duracion;
    }

    // Muestra un resumen de la cinta de vídeo
    public function muestraResumen(): string
    {
        $mensaje = "<div>";
        $mensaje .= "<strong>Pelicula en VHS</strong><br>";
        $mensaje .= "Título: " . $this->getTitulo() . "<br>";
        $mensaje .= "Duración: " . $this->duracion . " minutos<br>";
        $mensaje .= "Precio con IVA: " . number_format($this->getPrecioConIva(), 2) . " €";
        $mensaje .= "</div>";

        echo $mensaje;
        return $mensaje; // permite encadenamiento
    }
}

