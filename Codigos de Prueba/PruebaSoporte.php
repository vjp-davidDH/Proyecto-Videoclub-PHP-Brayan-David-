<?php
//Todo esto no funcionara debido a que hemos convertido a Soporte en una clase abstracta

// Incluimos la clase Soporte
include "../Clases/Soporte.php";

// Creamos un objeto Soporte con título, número y precio
$soporte1 = new Soporte("Tenet", 22, 3); 

// Mostramos el título en negrita
echo "<strong>" . $soporte1->titulo . "</strong>"; 

// Mostramos el precio sin IVA
echo "<br>Precio: " . $soporte1->getPrecio() . " euros"; 

// Mostramos el precio con IVA incluido
echo "<br>Precio IVA incluido: " . $soporte1->getPrecioConIVA() . " euros";

// Mostramos un resumen del soporte
$soporte1->muestraResumen();
?>
