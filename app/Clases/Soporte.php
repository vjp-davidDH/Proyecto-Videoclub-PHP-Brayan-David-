<?php
namespace Dwes\ProyectoVideoclub;
require_once __DIR__ . '/../../Interfaces/Resumible.php';
/**
 * Clase Soporte v0.331
 */

// Incluimos la interfaz Resumible

//include_once "../Interfaces/Resumible.php";

// Clase que representa un soporte (por ejemplo, un libro o revista)
abstract class Soporte implements Resumible {

    // Constante protegida del IVA (21%)
    protected const IVA = 0.21;

    // Propiedades de la clase
    public $titulo;      // título del soporte
    protected $numero;   // número de edición o referencia
    private $precio;     // precio base del soporte
    public $alquilado = false; // indica si el soporte está alquilado

    // Constructor: inicializa las propiedades al crear un objeto
    public function __construct($titulo, $precio) {
        $this->titulo = $titulo;
        $this->precio = $precio;
    }

    // Devuelve el título
    public function getTitulo()
    {
        return $this->titulo;
    }

    // Devuelve el número
    public function getNumero()
    {
        return $this->numero;
    }

    // Devuelve el precio base
    public function getPrecio()
    {
        return $this->precio;
    }

    // Devuelve el precio con IVA incluido
    public function getPrecioConIva()
    {
        return $this->precio + ($this->precio * self::IVA); // accedemos a la constante IVA con self
    }

    // Muestra un resumen sencillo del soporte
    abstract public function muestraResumen(): static;
}
?>
