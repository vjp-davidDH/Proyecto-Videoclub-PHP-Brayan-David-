<?php
namespace Dwes\ProyectoVideoclub;
require_once __DIR__ . '/../../Interfaces/Resumible.php';
// Incluimos la clase base Soporte
// include_once "Soporte.php";  (Ya no es necesario por el autoload)

/**
 * Juego v0.331
 */

// Clase que representa un Juego (hereda de Soporte)
class Juego extends Soporte {
    public $consola;             // consola en la que se juega
    private $minNumJugadores;    // número mínimo de jugadores
    private $maxNumJugadores;    // número máximo de jugadores

    // Constructor: inicializa título, número, precio, consola y número de jugadores
    public function __construct($titulo, $precio, $consola, $minNumJugadores, $maxNumJugadores) {
        parent::__construct($titulo, $precio); // llamamos al constructor de la clase padre
        $this->consola = $consola;
        $this->minNumJugadores = $minNumJugadores;
        $this->maxNumJugadores = $maxNumJugadores;
    }

    // Devuelve una descripción de cuántos jugadores pueden jugar
    public function muestraJugadoresPosibles() : string{
        $resultado = "";
        if ($this->maxNumJugadores == 1) {
            $resultado = "Para un jugador";
        }
        else if ($this->minNumJugadores > 0){
            $resultado = "De " . $this->minNumJugadores . " a " . $this->maxNumJugadores . " jugadores";
        }
        else {
            $resultado = "Para " . $this->maxNumJugadores . " jugadores";
        }

        return $resultado;
    }

    // Muestra un resumen del Juego
    public function muestraResumen(): static { // cambio a self para que perimita encadenamiento
        echo "<br>Juego para: " . $this->consola;         // indicamos la consola
        echo "<br>" . $this->muestraJugadoresPosibles();  // mostramos la información de jugadores posibles
        return $this; // permite encadenamiento
    }
}
?>
