<?php
namespace Dwes\ProyectoVideoclub;
// Interfaz que obliga a implementar el método muestraResumen
interface Resumible {
    public function muestraResumen(): static; // cualquier clase que implemente esta interfaz debe definir este método
}
?>