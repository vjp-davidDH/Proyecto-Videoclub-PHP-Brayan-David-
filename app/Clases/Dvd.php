<?php
namespace Dwes\ProyectoVideoclub;
require_once __DIR__ . '/../../Interfaces/Resumible.php';
/**
 * Dvd v0.331
 */

// Incluimos la clase base Soporte
// include_once "Soporte.php";  (Ya no es necesario por el autoload)

// Clase que representa un DVD (hereda de Soporte)
class Dvd extends Soporte
{

    public $idiomas;            // idiomas disponibles del DVD
    private $formatoPantalla;   // formato de pantalla (por ejemplo, 16:9)
    public $duracion;           // duración en minutos

    // Constructor: inicializa título, número, precio, idiomas, formatoPantalla y duración
    public function __construct($titulo, $precio, $idiomas, $formatoPantalla, $duracion)
    {
        parent::__construct($titulo, $precio); // llamamos al constructor de la clase padre
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
        $this->duracion = $duracion;
    }

    // Muestra un resumen del DVD
    public function muestraResumen(): string
    {
        $mensaje = "<br>Pelicula en DVD";        // indicamos que es un DVD
        $mensaje .= "<br>Idiomas: " . $this->idiomas;            // mostramos idiomas
        $mensaje .= "<br>Formato Pantalla: " . $this->formatoPantalla; // mostramos formato de pantalla
        $mensaje .= "<br>Duración: " . $this->duracion . " minutos";
        echo $mensaje;
        return $mensaje; // permite encadenamiento
    }
}

?>