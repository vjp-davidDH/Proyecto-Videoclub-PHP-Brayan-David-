<?php

// Incluimos la clase base Soporte
include_once "Soporte.php";

// Clase que representa un DVD (hereda de Soporte)
class Dvd extends Soporte {

    public $idiomas;            // idiomas disponibles del DVD
    private $formatoPantalla;   // formato de pantalla (por ejemplo, 16:9)

    // Constructor: inicializa título, número, precio, idiomas y formatoPantalla
    public function __construct($titulo, $precio, $idiomas, $formatoPantalla) {
        parent::__construct($titulo, $precio); // llamamos al constructor de la clase padre
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    // Muestra un resumen del DVD
    public function muestraResumen(): void {
        echo "<br>Pelicula en DVD";        // indicamos que es un DVD
        echo "<br>Idiomas: " . $this->idiomas;            // mostramos idiomas
        echo "<br>Formato Pantalla: " . $this->formatoPantalla; // mostramos formato de pantalla
    }
}

?>
