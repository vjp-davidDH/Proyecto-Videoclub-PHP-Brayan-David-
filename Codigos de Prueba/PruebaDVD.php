<?php
// Incluimos la clase Dvd
include "../Clases/Dvd.php";

// Creamos un objeto Dvd con título, número, precio, idiomas y formato de pantalla
$miDvd = new Dvd("Origen", 24, 15, "es,en,fr", "16:9"); 

// Mostramos el título en negrita
echo "<strong>" . $miDvd->titulo . "</strong>"; 

// Mostramos el precio sin IVA
echo "<br>Precio: " . $miDvd->getPrecio() . " euros"; 

// Mostramos el precio con IVA incluido
echo "<br>Precio IVA incluido: " . $miDvd->getPrecioConIva() . " euros";

// Mostramos un resumen del DVD (incluye idiomas y formato de pantalla)
$miDvd->muestraResumen();
?>
