<?php
namespace Dwes\ProyectoVideoclub\Tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\CintaVideo;

class CintaVideoTest extends TestCase
{

    public function testConstructor()
    {
        $cinta = new CintaVideo("Los Cazafantasmas", 3.5, 107);
        $this->assertEquals("Los Cazafantasmas", $cinta->getTitulo());
        $this->assertEquals(3.5, $cinta->getPrecio());
    }

    public function testMuestraResumen()
    {
        $cinta = new CintaVideo("Los Cazafantasmas", 3.5, 107);

        ob_start();
        $resultado = $cinta->muestraResumen();
        $output = ob_get_clean();

        // Verificar que devuelve el string y además hace echo del mismo
        $this->assertEquals($output, $resultado);

        $this->assertStringContainsString("Los Cazafantasmas", $resultado);
        $this->assertStringContainsString("107 minutos", $resultado);
        $this->assertStringContainsString("Pelicula en VHS", $resultado);
    }
}
