<?php
namespace Dwes\ProyectoVideoclub;

require_once __DIR__ . '/../../Interfaces/Resumible.php';

/**
 * CintaVideo v0.331
 */

// Clase que representa una cinta de vídeo (hereda de Soporte)
class CintaVideo extends Soporte {
    
    private $duracion; // duración en minutos

    // Constructor: inicializa título, número, precio y duración
    public function __construct($titulo, $precio, $duracion) {
        parent::__construct($titulo, $precio); // llamamos al constructor de la clase padre
        $this->duracion = $duracion;
    }

    // Muestra un resumen de la cinta de vídeo
    public function muestraResumen(): static {
        echo "<div>";
        echo "<strong>Pelicula en VHS</strong><br>";
        echo "Título: " . $this->getTitulo() . "<br>";
        echo "Duración: " . $this->duracion . " minutos<br>";
        echo "Precio con IVA: " . number_format($this->getPrecioConIva(), 2) . " €";
        echo "</div>";
        return $this; // permite encadenamiento
    }
}

