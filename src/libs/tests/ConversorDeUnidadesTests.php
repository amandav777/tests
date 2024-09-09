<?php
require "src/ConversorDeUnidades.php";
use PHPUnit\Framework\TestCase;

class ConversorDeUnidadesTest extends TestCase
{
    protected $conversor;

    protected function setUp(): void
    {
        $this->conversor = new ConversorDeUnidades();
    }

    // Testes para Conversão de Temperatura
    public function testConverterTemperaturaValido()
    {
        $this->assertEquals(32, $this->conversor->converterTemperatura(0, 'C', 'F'));
        $this->assertEquals(0, $this->conversor->converterTemperatura(32, 'F', 'C'));
        $this->assertEquals(273.15, $this->conversor->converterTemperatura(0, 'C', 'K'));
        $this->assertEquals(0, $this->conversor->converterTemperatura(273.15, 'K', 'C'));
    }

    public function testConverterTemperaturaInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->conversor->converterTemperatura(0, 'C', 'X'); // Unidade inexistente
    }

    // Testes para Conversão de Distância
    public function testConverterDistanciaValido()
    {
        $this->assertEquals(1000, $this->conversor->converterDistancia(1, 'km', 'm'));
        $this->assertEquals(0.01, $this->conversor->converterDistancia(1, 'm', 'cm'));
        $this->assertEquals(1000, $this->conversor->converterDistancia(1, 'm', 'mm'));
    }

    public function testConverterDistanciaInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->conversor->converterDistancia(1, 'km', 'ft'); // Unidade inexistente
    }

    // Testes para Conversão de Velocidade
    public function testConverterVelocidadeValido()
    {
        $this->assertEquals(3.6, $this->conversor->converterVelocidade(1, 'm/s', 'km/h'));
        $this->assertEquals(0.44704, round($this->conversor->converterVelocidade(1, 'mph', 'm/s'), 5));
    }

    public function testConverterVelocidadeInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->conversor->converterVelocidade(1, 'm/s', 'km/h'); // Velocidade correta
        $this->conversor->converterVelocidade(1, 'm/s', 'kn'); // Unidade inexistente
    }

    // Testes para Conversão de Peso
    public function testConverterPesoValido()
    {
        $this->assertEquals(1000, $this->conversor->converterPeso(1, 'kg', 'g'));
        $this->assertEquals(2.20462, round($this->conversor->converterPeso(1, 'kg', 'lb'), 5));
    }

    public function testConverterPesoInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->conversor->converterPeso(1, 'kg', 'oz'); // Unidade inexistente
    }

    // Testes para Conversão de Volume
    public function testConverterVolumeValido()
    {
        $this->assertEquals(1000, $this->conversor->converterVolume(1, 'l', 'ml'));
        $this->assertEquals(0.264172, round($this->conversor->converterVolume(1, 'l', 'gal'), 6));
    }

    public function testConverterVolumeInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->conversor->converterVolume(1, 'l', 'cup'); // Unidade inexistente
    }
}
