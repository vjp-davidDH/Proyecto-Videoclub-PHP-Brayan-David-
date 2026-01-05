<?php
namespace Dwes\ProyectoVideoclub\Tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Cliente;
use Dwes\ProyectoVideoclub\Soporte;
use Dwes\Videoclub\Exception\CupoSuperadoException;
use Dwes\Videoclub\Exception\SoporteYaAlquiladoException;
use Dwes\Videoclub\Exception\SoporteNoEncontradoException;

class ClienteTest extends TestCase
{

    public function testConstructor()
    {
        $cliente = new Cliente("Juan", 1, "juan", "1234", 5);
        $this->assertEquals("Juan", $cliente->nombre);
        $this->assertEquals(1, $cliente->getNumero());
        $this->assertEquals("juan", $cliente->getUser());
    }

    /**
     * @dataProvider cupoProvider
     */
    public function testAlquilarRespetandoCupo($cupo, $intentos, $exitoEsperado)
    {
        $cliente = new Cliente("Test", 1, "test", "pass", $cupo);
        $soportes = [];
        for ($i = 0; $i < $intentos; $i++) {
            // Mock Soporte
            $s = new class ("Soporte $i", 10) extends Soporte {
                public function muestraResumen(): string
                {
                    return "";
                }
            };
            $soportes[] = $s;
        }

        try {
            foreach ($soportes as $s) {
                $cliente->alquilar($s);
            }
            if (!$exitoEsperado) {
                $this->fail("Debería haber lanzado CupoSuperadoException");
            }
        } catch (CupoSuperadoException $e) {
            if ($exitoEsperado) {
                $this->fail("No debería haber lanzado excepción con cupo suficiente. " . $e->getMessage());
            }
        }

        $esperados = $exitoEsperado ? $intentos : $cupo;
        // Si falló, habrá alquilado hasta el cupo.
        $this->assertCount($esperados, $cliente->getAlquileres());
    }

    public function cupoProvider()
    {
        return [
            "Cupo suficiente" => [3, 2, true],
            "Cupo exacto" => [3, 3, true],
            "Cupo excedido" => [3, 4, false],
        ];
    }

    public function testAlquilerYaAlquilado()
    {
        $cliente = new Cliente("Test", 1, "test", "pass");
        $soporte = new class ("Ya alquilado", 10) extends Soporte {
            public $alquilado = true;
            public function muestraResumen(): string
            {
                return "";
            }
        };

        $this->expectException(SoporteYaAlquiladoException::class);
        $cliente->alquilar($soporte);
    }

    public function testTieneAlquilado()
    {
        $cliente = new Cliente("Test", 1, "test", "pass");
        $soporte = new class ("Soporte", 10) extends Soporte {
            public function muestraResumen(): string
            {
                return "";
            }
        };

        $this->assertFalse($cliente->tieneAlquilado($soporte));
        $cliente->alquilar($soporte);
        $this->assertTrue($cliente->tieneAlquilado($soporte));
    }

    public function testDevolver()
    {
        $cliente = new Cliente("Test", 1, "test", "pass");
        $soporte = new class ("Soporte", 10) extends Soporte {
            public function muestraResumen(): string
            {
                return "";
            }
        };

        $cliente->alquilar($soporte);
        $this->assertCount(1, $cliente->getAlquileres());

        $cliente->devolver($soporte);
        $this->assertCount(0, $cliente->getAlquileres());
        $this->assertFalse($soporte->alquilado);
    }

    public function testDevolverNoAlquilado()
    {
        $cliente = new Cliente("Test", 1, "test", "pass");
        $soporte = new class ("Soporte", 10) extends Soporte {
            public function muestraResumen(): string
            {
                return "";
            }
        };

        $this->expectException(SoporteNoEncontradoException::class);
        $cliente->devolver($soporte);
    }

    public function testAlquilerDuplicadoMismoSoporte()
    {
        // "que no coincidan los ids de los soportes"
        $cliente = new Cliente("Test", 1, "test", "pass");
        $soporte = new class ("Soporte", 10) extends Soporte {
            public function muestraResumen(): string
            {
                return "";
            }
        };

        $cliente->alquilar($soporte);

        $this->expectException(SoporteYaAlquiladoException::class);
        $cliente->alquilar($soporte);
    }
}
