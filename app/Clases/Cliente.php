<?php
namespace Dwes\ProyectoVideoclub;

class Cliente
{
    public $nombre;                       // Nombre del cliente (accesible públicamente)
    private $numero;                      // Número identificador del cliente
    private $user;                        // Nombre de usuario para login
    private $password;                    // Contraseña del cliente
    private $soporteAlquilados = [];      // Lista de soportes actualmente alquilados
    private $numSoportesAlquilados = 0;   // Total de soportes alquilados
    private $maxAlquilerConcurrente;      // Límite máximo de alquiler simultáneo

    public function __construct($nombre, $numero, $user, $password, $maxAlquilerConcurrente = 3)
    {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->user = $user;
        $this->password = $password;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    // Devuelve el número identificador del cliente
    public function getNumero()
    {
        return $this->numero;
    }

    // Devuelve el nombre de usuario del cliente
    public function getUser(): string
    {
        return $this->user;
    }

    // Devuelve la contraseña del cliente
    public function getPassword(): string
    {
        return $this->password;
    }

    // Devuelve el número actual de soportes alquilados
    public function getNumSoportesAlquilados()
    {
        return $this->numSoportesAlquilados;
    }

    /**
     * Añade un soporte al registro de alquileres.
     * No valida límites aquí: se supone que otro método controla
     * si el cliente puede alquilar más.
     */
    public function añadirSoporte(Soporte $soporte): self
    {
        $this->soporteAlquilados[] = $soporte;
        $this->numSoportesAlquilados++;
        return $this;
    }

    // Devuelve la lista completa de soportes alquilados
    public function getAlquileres(): array
    {
        return $this->soporteAlquilados;
    }

    /**
     * Comprueba si el cliente tiene alquilado un soporte.
     * @param Soporte $s
     * @return bool
     */
    public function tieneAlquilado(Soporte $s): bool
    {
        // Comprobamos si el soporte está en el array de alquilados
        // Lo ideal es buscar por objeto o por algún ID único si Soporte lo tuviera.
        // Dado que no hay ID explícito en Soporte (a menos que numero sea el ID?), usamos in_array estricto?
        // O comparamos propiedades?
        // En Videoclub se pasa el objeto del array de productos.
        return in_array($s, $this->soporteAlquilados, true);
    }

    /**
     * Alquila un soporte al cliente.
     * @param Soporte $s
     * @return self
     * @throws \Dwes\Videoclub\Exception\CupoSuperadoException
     * @throws \Dwes\Videoclub\Exception\SoporteYaAlquiladoException
     */
    public function alquilar(Soporte $s): self
    {
        // 1. Comprobar si ya lo tiene alquilado (o si está alquilado en general)
        if ($this->tieneAlquilado($s)) {
            throw new \Dwes\Videoclub\Exception\SoporteYaAlquiladoException("El cliente ya tiene alquilado este soporte.");
            // Ojo: SoporteYaAlquilado suele referirse a que ALGUIEN lo tiene. 
            // Si el cliente lo tiene, lo tiene alquilado.
        }

        if ($s->alquilado) {
            throw new \Dwes\Videoclub\Exception\SoporteYaAlquiladoException("El soporte ya está alquilado.");
        }

        // 2. Comprobar cupo
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            throw new \Dwes\Videoclub\Exception\CupoSuperadoException("Cupo de alquileres superado.");
        }

        // 3. Realizar alquiler
        $this->soporteAlquilados[] = $s;
        $this->numSoportesAlquilados++;
        $s->alquilado = true; // Marcamos soporte como alquilado.

        return $this;
    }

    /**
     * Devuelve un soporte alquilado.
     * @param Soporte $s
     * @return self
     * @throws \Dwes\Videoclub\Exception\SoporteNoEncontradoException
     */
    public function devolver(Soporte $s): self
    {
        // Buscar el soporte y eliminarlo
        $key = array_search($s, $this->soporteAlquilados, true);

        if ($key === false) {
            throw new \Dwes\Videoclub\Exception\SoporteNoEncontradoException("El soporte no está alquilado por este cliente.");
        }

        unset($this->soporteAlquilados[$key]);
        // Reindexar array? No es estrictamente necesario pero es limpio.
        $this->soporteAlquilados = array_values($this->soporteAlquilados);

        $this->numSoportesAlquilados--;
        $s->alquilado = false; // Marcamos como disponible

        return $this;
    }

    /**
     * Muestra resumen del cliente
     */
    public function muestraResumen(): string
    {
        echo "Nombre: " . $this->nombre . "<br>";
        echo "Cantidad de alquileres: " . count($this->soporteAlquilados) . "<br>";
        return "Nombre: " . $this->nombre . "<br>Cantidad de alquileres: " . count($this->soporteAlquilados) . "<br>";
    }
}
// comentarios generados por ChatGPT 
?>