<?php
namespace Dwes\ProyectoVideoclub;

/**
 * CintaVideo v0.331
 */

// Incluimos la clase base Soporte
// include_once "Soporte.php"; (Ya no es necesario por el autoload)

// Clase que representa una cinta de vídeo (hereda de Soporte)
class CintaVideo extends Soporte {
    
    private $duracion; // duración en minutos

    // Constructor: inicializa título, número, precio y duración
    public function __construct($titulo, $precio, $duracion) {
        parent::__construct($titulo, $precio); // llamamos al constructor de la clase padre
        $this->duracion = $duracion;
    }

    // Muestra un resumen de la cinta de vídeo
    public function muestraResumen(): self {
        echo "<br>Pelicula en VHS";  // indicamos que es una película en VHS
        echo "<br>Duracion: " . $this->duracion . " minutos"; // mostramos la duración
        return $this; // permite encadenamiento
    }
}
?>
