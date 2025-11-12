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

  public function muestraResumen(): void {
        echo "<div>";
        echo "<strong>Pelicula en VHS</strong><br>";
        echo "Título: " . $this->getTitulo() . "<br>";
        echo "Duración: " . $this->duracion . " minutos<br>";
        echo "Precio con IVA: " . number_format($this->getPrecioConIva(), 2) . " €";
        echo "</div>";
    }
}
?>
