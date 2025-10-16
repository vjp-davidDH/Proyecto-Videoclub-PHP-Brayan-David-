<?php
// Incluimos la clase Juego
include "../Clases/Juego.php";

// Importamos el namespace
use Dwes\ProyectoVideoclub\Juego;

// Creamos un objeto Juego con título, número, precio, plataforma, jugabilidad y multijugador
$miJuego = new Juego("The Last of Us Part II", 26, 49.99, "PS4", 1, 1); 

// Mostramos el título en negrita
echo "<strong>" . $miJuego->titulo . "</strong>"; 

// Mostramos el precio sin IVA
echo "<br>Precio: " . $miJuego->getPrecio() . " euros"; 

// Mostramos el precio con IVA incluido
echo "<br>Precio IVA incluido: " . $miJuego->getPrecioConIva() . " euros";

// Mostramos un resumen del juego (incluye plataforma y jugabilidad)
$miJuego->muestraResumen();
?>
