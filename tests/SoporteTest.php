<?php
namespace Dwes\ProyectoVideoclub\Tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Soporte;

class SoporteTest extends TestCase
{

    public function testConstructor()
    {
        // Clase anónima para probar abstract class
        $soporte = new class ("Titulo Test", 100) extends Soporte {
            public function muestraResumen(): string
            {
                return "Resumen Test";
            }
        };

        $this->assertEquals("Titulo Test", $soporte->getTitulo());
        $this->assertEquals(100, $soporte->getPrecio());
        $this->assertEquals(121, $soporte->getPrecioConIva());
        $this->assertFalse($soporte->alquilado);
    }
}
