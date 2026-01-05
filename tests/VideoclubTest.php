<?php
namespace Dwes\ProyectoVideoclub\Tests;

use PHPUnit\Framework\TestCase;
use Dwes\ProyectoVideoclub\Videoclub;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\Videoclub\Exception\ClienteNoExisteException;

class VideoclubTest extends TestCase
{

    public function testIncluirProductosYSocios()
    {
        $vc = new Videoclub("Blockbuster");
        $vc->incluirJuego("God of War", 60, "PS4", 1, 1);
        $vc->incluirSocio("Juan", 1, "juan", "1234");

        $this->assertInstanceOf(Videoclub::class, $vc);
    }

    public function testAlquilarSocioProducto()
    {
        $vc = new Videoclub("Blockbuster");
        $vc->incluirJuego("God of War", 60, "PS4", 1, 1); // Index 0
        $vc->incluirSocio("Juan", 1, "juan", "1234"); // Index 0

        // Alquilar
        ob_start();
        $vc->alquilarSocioProducto(0, 0);
        $output = ob_get_clean();

        $this->assertStringContainsString("Alquilado con éxito", $output);
        $this->assertEquals(1, $vc->getNumProductosAlquilados());
    }

    public function testAlquilarSocioProductosArray()
    {
        $vc = new Videoclub("Blockbuster");
        $vc->incluirJuego("GOW", 60, "PS4", 1, 1); // 0
        $vc->incluirJuego("TLOU", 60, "PS4", 1, 1); // 1
        $vc->incluirSocio("Juan", 1, "juan", "1234");

        ob_start();
        $vc->alquilarSocioProductos(0, [0, 1]);
        $output = ob_get_clean();

        $this->assertStringContainsString("Alquilado con éxito", $output);
        $this->assertEquals(2, $vc->getNumProductosAlquilados());
    }

    public function testDevolverSocioProducto()
    {
        $vc = new Videoclub("Blockbuster");
        $vc->incluirJuego("GOW", 60, "PS4", 1, 1); // 0
        $vc->incluirSocio("Juan", 1, "juan", "1234");

        $vc->alquilarSocioProducto(0, 0);

        ob_start();
        $vc->devolverSocioProducto(0, 0);
        $output = ob_get_clean();

        $this->assertStringContainsString("devuelto por", $output);
        $this->assertEquals(0, $vc->getNumProductosAlquilados());
    }

    public function testAlquilarClienteNoExiste()
    {
        $vc = new Videoclub("Blockbuster");

        $this->expectException(ClienteNoExisteException::class);
        $vc->alquilarSocioProducto(99, 0);
    }

    public function testDevolverClienteNoExiste()
    {
        $vc = new Videoclub("Blockbuster");

        $this->expectException(ClienteNoExisteException::class);
        $vc->devolverSocioProducto(99, 0);
    }
}
