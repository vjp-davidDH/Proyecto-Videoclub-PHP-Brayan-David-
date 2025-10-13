<?php
// Incluimos la clase CintaVideo
include "../Clases/CintaVideo.php";

// Creamos un objeto CintaVideo con título, número, precio y duración
$miCinta = new CintaVideo("Los cazafantasmas", 23, 3.5, 107); 

// Mostramos el título en negrita
echo "<strong>" . $miCinta->titulo . "</strong>"; 

// Mostramos el precio sin IVA
echo "<br>Precio: " . $miCinta->getPrecio() . " euros"; 

// Mostramos el precio con IVA incluido
echo "<br>Precio IVA incluido: " . $miCinta->getPrecioConIva() . " euros";

// Mostramos un resumen de la cinta (incluye duración)
$miCinta->muestraResumen();
?>
