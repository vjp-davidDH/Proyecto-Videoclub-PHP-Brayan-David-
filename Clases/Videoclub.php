<?php
// Incluimos todas las clases necesarias
namespace Dwes\ProyectoVideoclub;

include_once("Soporte.php");
include_once("Cliente.php");
include_once("Juego.php");
include_once("Dvd.php");
include_once("CintaVideo.php");


/**
 * Videoclub v0.331
 */

// Clase que representa un videoclub
class Videoclub {

    private $nombre;          // nombre del videoclub
    private $productos = [];  // array de productos (CintaVideo, Dvd, Juego)
    private $numProductos;    // contador de productos
    private $socios = [];     // array de clientes/socios
    private $numSocios;       // contador de socios

    // Constructor: inicializa el nombre del videoclub
    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->numProductos = 0;
        $this->numSocios = 0;// inicializamos los contenedores asi evitames posibles errroes de undefined
    }

    // Añade un producto al array de productos (privado, solo uso interno)
    private function incluirProducto(Soporte $producto) {
        $this->productos[] = $producto;
        echo "<br>Incluido soporte<br>"; // mensaje de confirmación
        $this->numProductos++;
    }

    // Crea y añade una cinta de vídeo al videoclub
    public function incluirCintaVideo($titulo,  $precio, $duracion): self { 
    $cintaVideo = new CintaVideo($titulo,  $precio, $duracion);
    $this->incluirProducto($cintaVideo);
    return $this; // devuelve el objeto Videoclub para encadenar llamadas
}

    // Crea y añade un DVD al videoclub
    public function incluirDvd($titulo,  $precio, $idiomas, $formatoPantalla): self {
    $dvd = new Dvd($titulo,  $precio, $idiomas, $formatoPantalla);
    $this->incluirProducto($dvd);
    return $this; 
}

    // Crea y añade un Juego al videoclub
    public function incluirJuego($titulo,  $precio, $consola, $minNumJugadores, $maxNumJugadores): self {
    $juego = new Juego($titulo,  $precio, $consola, $minNumJugadores, $maxNumJugadores);
    $this->incluirProducto($juego);
    return $this;
}

    // Crea y añade un socio/cliente al videoclub
    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3): self {
    $cliente = new Cliente($nombre, $maxAlquileresConcurrentes);
    $this->socios[] = $cliente;
    $this->numSocios++;
    return $this;
}

    // Lista todos los productos del videoclub
    public function listarProductos() {
        foreach ($this->productos as $p) {
            echo "<br>Titulo: " . $p->getTitulo();
            echo "<br>Precio: " . $p->getPrecio();
            echo "<br>" . $p->muestraResumen(); // muestra detalles según tipo de soporte
        }
    }

    // Lista todos los socios del videoclub
    public function listarSocios() {
        foreach ($this->socios as $s) {
            echo "<br>" . $s->muestraResumen(); // muestra resumen del cliente
        }
    }

    // Permite que un socio alquile un producto según sus índices en los arrays
    public function alquilarSocioProducto($numeroCliente, $numeroSoporte): self {
    if (!isset($this->socios[$numeroCliente]) || !isset($this->productos[$numeroSoporte])) {
        echo "<br>Error: cliente o producto no encontrado<br>";
        return $this;
    }

    $socio = $this->socios[$numeroCliente];
    $producto = $this->productos[$numeroSoporte];
    $socio->alquilar($producto);

    return $this; // lo modificamos para que perimita encadenar llamdas
    }
}

?>
