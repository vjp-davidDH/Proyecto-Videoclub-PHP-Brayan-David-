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
}
// comentarios generados por ChatGPT 
?>

