<?php
// Incluimos todas las clases necesarias
namespace Dwes\ProyectoVideoclub;

// (Ya no es necesario por el autoload)
// include_once("Soporte.php");
// include_once("Cliente.php");
// include_once("Juego.php");
// include_once("Dvd.php");
// include_once("CintaVideo.php");


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

    // propiedades nuevas
    private $numProductosAlquilados =0; // contador de productos alquilados
    private $numTotalAlquileres = 0;    // contador total de alquileres realizados

    // Constructor: inicializa el nombre del videoclub
    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->numProductos = 0;
        $this->numSocios = 0;// inicializamos los contenedores asi evitames posibles errroes de undefined
    }
    // Devuelve el número de productos alquilados
    public function getNumProductosAlquilados(): int
{
    $contador = 0;
    foreach ($this->productos as $producto) {
        if ($producto->alquilado) {
            $contador++;
        }
    }
    return $contador;
}

    // Devuelve el número total de alquileres realizados
    public function getNumProductosAlquiladosTotal(): int
    {
        return $this -> numTotalAlquileres;
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
            echo "Titulo: " . $p->getTitulo();
            echo "Precio: " . $p->getPrecio();
            echo $p->muestraResumen(); // muestra detalles según tipo de soporte
        }
    }

    // Lista todos los socios del videoclub
    public function listarSocios() {
        foreach ($this->socios as $s) {
            echo $s->muestraResumen(); // muestra resumen del cliente
        }
    }

    // Permite que un socio alquile un producto según sus índices en los arrays
    public function alquilarSocioProducto($numeroCliente, $numeroSoporte): self
    {
        if (!isset($this->socios[$numeroCliente])) {
            echo "Error: cliente con índice {$numeroCliente} no encontrado";
            return $this;
        }

        if (!isset($this->productos[$numeroSoporte])) {
            echo "Error: producto con índice {$numeroSoporte} no encontrado";
            return $this;
        }

        $socio = $this->socios[$numeroCliente];
        $producto = $this->productos[$numeroSoporte];

        try {
            $socio->alquilar($producto);
            echo "Alquilado con éxito:'{$producto->getTitulo()}' al cliente '{$socio->nombre}'";
        } catch (SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage();
        } catch (LimiteAlquileresExcedidoException $e) {
            echo "Error: " . $e->getMessage();
        } catch (\Exception $e) {
            // Captura cualquier otra excepción inesperada (buena práctica)
            echo "Error inesperado al alquilar: " . $e->getMessage();
        }

        return $this;
    }

    public function alquilarSocioProductos(int $numSocio, array $numerosProductos): self {
    // Verificar que el socio existe
    if (!isset($this->socios[$numSocio])) {
        echo "Error: cliente con índice {$numSocio} no encontrado<br>";
        return $this;
    }

    $socio = $this->socios[$numSocio];
    $productosAAlquilar = [];

    // Verificar que todos los productos existen y están disponibles
    foreach ($numerosProductos as $indiceProducto) {
        if (!isset($this->productos[$indiceProducto])) {
            echo "Error: producto con índice {$indiceProducto} no existe<br>";
            return $this;
        }

        $producto = $this->productos[$indiceProducto];

        if ($producto->alquilado) {
            echo "Error: el producto '{$producto->getTitulo()}' ya está alquilado<br>";
            return $this;
        }

        $productosAAlquilar[] = $producto;
    }

    // Intentar alquilar todos los productos
    try {
        foreach ($productosAAlquilar as $producto) {
            $socio->alquilar($producto);
            echo "Alquilado con éxito: '{$producto->getTitulo()}' al cliente '{$socio->nombre}'<br>";
            $this->numTotalAlquileres++;
        }
    } catch (LimiteAlquileresExcedidoException $e) {
        echo "Error: " . $e->getMessage() . "<br>";
    } catch (\Exception $e) {
        echo "Error inesperado al alquilar: " . $e->getMessage() . "<br>";
    }

    return $this;
    }

    public function devolverSocioProducto(int $numSocio, int $numeroProducto): self {
    if (!isset($this->socios[$numSocio])) {
        echo "Error: cliente con índice {$numSocio} no encontrado<br>";
        return $this;
    }

    if (!isset($this->productos[$numeroProducto])) {
        echo "Error: producto con índice {$numeroProducto} no encontrado<br>";
        return $this;
    }

    $socio = $this->socios[$numSocio];
    $producto = $this->productos[$numeroProducto];

    // Verificamos que el producto esté alquilado por el socio
    if (!$socio->tieneAlquilado($producto)) {
        echo "Error: el producto '{$producto->getTitulo()}' no está alquilado por el cliente '{$socio->nombre}'<br>";
        return $this;
    }

    // Devolvemos el producto
    $socio->devolver($producto);
    $producto->alquilado = false;
    echo "Producto '{$producto->getTitulo()}' devuelto por '{$socio->nombre}'<br>";

    return $this;
}

public function devolverSocioProductos(int $numSocio, array $numerosProductos): self {
    if (!isset($this->socios[$numSocio])) {
        echo "Error: cliente con índice {$numSocio} no encontrado<br>";
        return $this;
    }

    $socio = $this->socios[$numSocio];
    $productosADevolver = [];

    foreach ($numerosProductos as $indiceProducto) {
        if (!isset($this->productos[$indiceProducto])) {
            echo "Error: producto con índice {$indiceProducto} no encontrado<br>";
            return $this;
        }

        $producto = $this->productos[$indiceProducto];

        if (!$socio->tieneAlquilado($producto)) {
            echo "Error: el producto '{$producto->getTitulo()}' no está alquilado por '{$socio->nombre}'<br>";
            return $this;
        }

        $productosADevolver[] = $producto;
    }

    // Todos los productos son válidos, se devuelven
    foreach ($productosADevolver as $producto) {
        $socio->devolver($producto);
        $producto->alquilado = false;
        echo "Producto '{$producto->getTitulo()}' devuelto por '{$socio->nombre}'<br>";
    }

    return $this;
}


}

?>
