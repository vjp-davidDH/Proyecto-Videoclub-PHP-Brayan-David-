<?php
namespace Dwes\ProyectoVideoclub\Tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Dvd;

class DvdTest extends TestCase
{

    public function testConstructor()
    {
        // Constructor actualizado con duración
        $dvd = new Dvd("Origen", 15, "es,en,fr", "16:9", 148);
        $this->assertEquals("Origen", $dvd->getTitulo());
        $this->assertEquals(15, $dvd->getPrecio());
    }

    public function testMuestraResumen()
    {
        $dvd = new Dvd("Origen", 15, "es,en,fr", "16:9", 148);

        ob_start();
        $resultado = $dvd->muestraResumen();
        $output = ob_get_clean();

        $this->assertEquals($output, $resultado);
        $this->assertStringContainsString("Pelicula en DVD", $resultado);
        $this->assertStringContainsString("es,en,fr", $resultado);
        $this->assertStringContainsString("16:9", $resultado);
        $this->assertStringContainsString("148 minutos", $resultado);
    }
}
