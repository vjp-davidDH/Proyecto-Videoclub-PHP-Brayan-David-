<?php
namespace Dwes\ProyectoVideoclub;
// include_once("Soporte.php");  (Ya no es necesario por el autoload)

/**
 * Cliente v0.331
 */

// Clase que representa un cliente del videoclub
class Cliente
{

    public $nombre;                     // nombre del cliente
    private $numero;                    // número de cliente
    private $soporteAlquilados = [];    // array de soportes alquilados
    private $numSoportesAlquilados = 0;     // contador de soportes alquilados
    private $maxAlquilerConcurrente;    // máximo de alquileres simultáneos permitidos

    // Constructor: inicializa nombre, número de cliente y límite de alquileres
    public function __construct($nombre, $numero, $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    // Devuelve el número de cliente
    public function getNumero()
    {
        return $this->numero;
    }

    // Establece un nuevo número de cliente
    public function setNumero($numero): self // para encadenar llamadas 
    {
        $this->numero = $numero;
        return $this;
    }

    // Devuelve el número de soportes actualmente alquilados
    public function getNumSoportesAlquilados()
    {
        return $this->numSoportesAlquilados;
    }

    // Añade un soporte al array de alquileres
    public function añadirSoporte(Soporte $soporte): self
{
    $this->soporteAlquilados[] = $soporte;
    $this->numSoportesAlquilados++;
    return $this; // permitimos el encadenamiento
}

    // Comprueba si un soporte ya está alquilado por el cliente
    public function tieneAlquilado(Soporte $s): bool
    {
        foreach ($this->soporteAlquilados as $soporte) {
            if ($s === $soporte) { 
                return true; 
            }
        }
        return false;
    }

    // Alquila un soporte si no se supera el límite y no está ya alquilado
    public function alquilar(Soporte $s): self // para encadenamiento completo
    {
        if ($this->tieneAlquilado($s)) {
            echo "<br>El cliente ya tiene alquilado el soporte <strong>" . $s->getTitulo() . "</strong><br>";
        } else if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            echo "<br>Este cliente tiene 3 elementos alquilados. No puede alquilar más hasta devolver algo<br>";
        } else {
            echo "<br><strong>Alquilado soporte a: </strong>" . $this->nombre . "<br>";
            echo "<br>Titulo: " . $s->getTitulo();
            echo "<br>Precio: " . $s->getPrecio();
            echo "<br>" . $s->muestraResumen();
            echo "<br>" . $s->muestraResumen();
            $this->añadirSoporte($s); // esto incrementa el contador
        }
        return $this;
    }

    // Devuelve un soporte según su índice en el array
    public function devolver(int $numSoporte): bool
    {
        if (isset($this->soporteAlquilados[$numSoporte])) {
            echo "<br>Se ha encontrado correctamente el soporte a devolver.<br>";
            unset($this->soporteAlquilados[$numSoporte]);
            echo "<br>Se ha devuelto el soporte con éxito.<br>";
            $this->numSoportesAlquilados--;
            return true;
        } else {
            echo "<br>No se ha encontrado el soporte en los alquileres de este cliente<br>";
        }
        return false;
    }

    // Lista todos los soportes alquilados por el cliente
    public function listaAlquileres(): self
    {
        if ($this->numSoportesAlquilados > 0) {
            echo "<br><strong>El cliente tiene " . $this->numSoportesAlquilados . " soportes alquilados</strong><br>";
            foreach ($this->soporteAlquilados as $s) {
                echo "<br>Titulo: " . $s->getTitulo();
                echo "<br>Precio: " . $s->getPrecio();
                echo "<br>" . $s->muestraResumen() . "<br>";
            }
        } else {
            echo "<br>Este cliente no tiene soportes alquilados.<br>";
        }
        return $this;
    }

    public function muestraResumen(): self
    {
        // Datos del cliente (solo una vez)
        echo "<br>Nombre: " . $this->nombre;
        echo "<br>Cantidad de alquileres: " . $this->numSoportesAlquilados . "<br>";

        // Listado de soportes alquilados
        if (!empty($this->soporteAlquilados)) {
            foreach ($this->soporteAlquilados as $soporte) {
                echo "<br>- Título: " . $soporte->getTitulo();
                echo $soporte->muestraResumen() . "<br>";
            }
        } else {
            echo "<br>Este cliente no tiene soportes alquilados.";
        }

        return $this;
    }
}
?>
