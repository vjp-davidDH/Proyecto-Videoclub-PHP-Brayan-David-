<?php
// Incluimos todas las clases necesarias
include_once("Soporte.php");
include_once("Cliente.php");
include_once("Juego.php");
include_once("Dvd.php");
include_once("CintaVideo.php");

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
    }

    // Añade un producto al array de productos (privado, solo uso interno)
    private function incluirProducto(Soporte $producto) {
        $this->productos[] = $producto;
        echo "<br>Incluido soporte<br>"; // mensaje de confirmación
        $this->numProductos++;
    }

    // Crea y añade una cinta de vídeo al videoclub
    public function incluirCintaVideo($titulo,  $precio, $duracion) {
        $cintaVideo = new CintaVideo($titulo,  $precio, $duracion);
        $this->incluirProducto($cintaVideo);
    }

    // Crea y añade un DVD al videoclub
    public function incluirDvd($titulo,  $precio, $idiomas, $formatoPantalla) {
        $dvd = new Dvd($titulo,  $precio, $idiomas, $formatoPantalla);
        $this->incluirProducto($dvd);
    }

    // Crea y añade un Juego al videoclub
    public function incluirJuego($titulo,  $precio, $consola, $minNumJugadores, $maxNumJugadores) {
        $juego = new Juego($titulo,  $precio, $consola, $minNumJugadores, $maxNumJugadores);
        $this->incluirProducto($juego);
    }

    // Crea y añade un socio/cliente al videoclub
    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3) {
        $cliente = new Cliente($nombre, $maxAlquileresConcurrentes);
        $this->socios[] = $cliente;
        echo "<br>Incluido socio.<br>"; // mensaje de confirmación
        $this->numSocios++;
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
    public function alquilarSocioProducto($numeroCliente, $numeroSoporte) {
        $socio = $this->socios[$numeroCliente];
        $producto = $this->productos[$numeroSoporte];

        if ($socio->alquilar($producto)) {
            echo "<br>Has podido alquilar correctamente<br>";
        } else {
            echo "<br>No has podido alquilar<br>";
        }
    }
}

?>
