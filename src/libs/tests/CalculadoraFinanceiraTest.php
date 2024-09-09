<?php
require "src/CalculadoraFinanceira.php";
use PHPUnit\Framework\TestCase;

class CalculadoraFinanceiraTest extends TestCase
{
    protected $calculadora;

    protected function setUp(): void
    {
        $this->calculadora = new CalculadoraFinanceira();
    }

    public function testCalcularValorFuturoValido()
    {
        $resultado = $this->calculadora->calcularValorFuturo(1000, 0.05, 10);
        $this->assertEquals(1628.89, round($resultado, 2)); // Arredondado para facilitar
    }

    public function testCalcularValorFuturoInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculadora->calcularValorFuturo(1000, -0.05, 10); 
    }

    public function testCalcularPagamentoEmpréstimoValido()
    {
        $resultado = $this->calculadora->calcularPagamentoEmpréstimo(5000, 0.05, 12);
        $this->assertEquals(429.41, round($resultado, 2));
    }

    public function testCalcularPagamentoEmpréstimoInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculadora->calcularPagamentoEmpréstimo(5000, 0.05, 0); 
    }

    public function testCalcularPeriodoParaDuplicarValido()
    {
        $resultado = $this->calculadora->calcularPeriodoParaDuplicar(0.05);
        $this->assertEquals(14.21, round($resultado, 2));
    }

    public function testCalcularPeriodoParaDuplicarInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculadora->calcularPeriodoParaDuplicar(0); 
    }

    public function testCalcularValorPresenteValido()
    {
        $resultado = $this->calculadora->calcularValorPresente(1628.89, 0.05, 10);
        $this->assertEquals(1000, round($resultado, 2)); 
    }

    public function testCalcularValorPresenteInvalido()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculadora->calcularValorPresente(1628.89, -0.05, 10); 
    }

}