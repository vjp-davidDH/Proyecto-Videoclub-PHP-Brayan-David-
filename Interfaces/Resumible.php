<?php
// Interfaz que obliga a implementar el método muestraResumen
interface Resumible {
    public function muestraResumen(): void; // cualquier clase que implemente esta interfaz debe definir este método
}
?>