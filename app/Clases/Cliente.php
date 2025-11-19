<?php
namespace Dwes\ProyectoVideoclub;

/**
 * Cliente v0.332 (actualizado con excepciones y encadenamiento)
 */
class Cliente
{
    public $nombre;                     // nombre del cliente
    private $numero;                    // número de cliente
    private $soporteAlquilados = [];    // array de soportes alquilados
    private $numSoportesAlquilados = 0; // contador de soportes alquilados
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
    public function setNumero($numero): self // para encadenamiento completo
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
    public function añadirSoporte(Soporte $soporte): self // para encadenamiento completo
    {
        $this->soporteAlquilados[] = $soporte;
        $this->numSoportesAlquilados++;
        return $this;
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
    public function alquilar(Soporte $s): self
    {
        if ($this->tieneAlquilado($s)) {
            throw new Util\SoporteYaAlquiladoException("El cliente ya tiene alquilado el soporte '{$s->getTitulo()}'.");
        }

        $this->añadirSoporte($s);
        return $this;
    }

    // Devuelve un soporte según su índice en el array
    public function devolver(int $numSoporte): self // para encadenamiento completo
    {
        if (!isset($this->soporteAlquilados[$numSoporte])) {
            throw new Util\SoporteNoEncontradoException("No se ha encontrado el soporte con índice {$numSoporte} en los alquileres de este cliente.");
        }

        unset($this->soporteAlquilados[$numSoporte]);
        $this->numSoportesAlquilados--;
        return $this;
    }

    // Lista todos los soportes alquilados por el cliente
    public function listaAlquileres(): self // para encadenamiento completo
    {
        if ($this->numSoportesAlquilados > 0) {
            echo "El cliente tiene " . $this->numSoportesAlquilados . " soportes alquilados";
            foreach ($this->soporteAlquilados as $s) {
                echo "Titulo: " . $s->getTitulo();
                echo "Precio: " . $s->getPrecio();
                echo $s->muestraResumen();
            }
        } else {
            echo "<br>Este cliente no tiene soportes alquilados.<br>";
        }
        return $this;
    }
    //  Muestra un resumen en pantalla con la información básica del cliente y los soportes (películas, juegos, etc.) que tiene actualmente alquilados.
    public function muestraResumen(): self
    {
        echo "Nombre: " . $this->nombre;
        echo "Cantidad de alquileres: " . $this->numSoportesAlquilados;

        if (!empty($this->soporteAlquilados)) {
            foreach ($this->soporteAlquilados as $soporte) {
                echo "Título: " . $soporte->getTitulo();
                echo $soporte->muestraResumen();
            }
        } else {
            echo "<br>Este cliente no tiene soportes alquilados.";
        }

        return $this;
    }
}
