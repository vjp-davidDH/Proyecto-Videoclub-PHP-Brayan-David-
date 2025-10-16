<?php
// Este fichero sirve para cargar las clases automáticamente

spl_autoload_register(function ($clase) {
    // Sustituimos el namespace base por la ruta real de las clases
    $ruta = str_replace("Dwes\\ProyectoVideoclub", __DIR__ . "/app/Clases", $clase);// la parte de las rutas me ayudo ChatGpt
    $ruta = str_replace("\\", "/", $ruta); // Convertimos \ a /
    $ruta .= ".php"; // Añadimos extensión .php

    if (file_exists($ruta)) {
        include_once $ruta;
    } else {
        echo "No existe la clase $clase en la ruta $ruta<br>";
    }
});
