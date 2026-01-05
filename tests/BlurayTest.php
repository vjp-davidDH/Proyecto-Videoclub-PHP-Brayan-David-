<?php
namespace Dwes\ProyectoVideoclub\Tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Bluray;

class BlurayTest extends TestCase
{

    public function testConstructor()
    {
        $bd = new Bluray("Avengers", 20, 180, true);
        $this->assertEquals("Avengers", $bd->getTitulo());
        $this->assertEquals(20, $bd->getPrecio());
    }

    public function testMuestraResumen()
    {
        $bd = new Bluray("Avengers", 20, 180, true);

        ob_start();
        $resultado = $bd->muestraResumen();
        $output = ob_get_clean();

        $this->assertEquals($output, $resultado);
        $this->assertStringContainsString("Película en Bluray", $resultado);
        $this->assertStringContainsString("4K", $resultado);
    }
}
