<?php
namespace Dwes\ProyectoVideoclub\Tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Juego;

class JuegoTest extends TestCase
{

    public function testConstructor()
    {
        $juego = new Juego("God of War", 60, "PS4", 1, 1);
        $this->assertEquals("God of War", $juego->getTitulo());
        $this->assertEquals(60, $juego->getPrecio());
    }

    public function testMuestraJugadoresPosibles()
    {
        // Un jugador
        $juego1 = new Juego("Solo", 50, "PC", 1, 1);
        $this->assertEquals("Para un jugador", $juego1->muestraJugadoresPosibles());

        // Rango
        $juegoRange = new Juego("Multi", 50, "PC", 2, 4);
        $this->assertEquals("De 2 a 4 jugadores", $juegoRange->muestraJugadoresPosibles());

        // Max solamente
        $juegoMax = new Juego("Party", 50, "PC", 0, 5);
        $this->assertEquals("Para 5 jugadores", $juegoMax->muestraJugadoresPosibles());
    }

    public function testMuestraResumen()
    {
        $juego = new Juego("God of War", 60, "PS4", 1, 1);

        ob_start();
        $resultado = $juego->muestraResumen();
        $output = ob_get_clean();

        $this->assertEquals($output, $resultado);
        $this->assertStringContainsString("Juego para: PS4", $resultado);
        $this->assertStringContainsString("Para un jugador", $resultado);
    }
}
