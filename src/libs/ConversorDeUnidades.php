<?php
class ConversorDeUnidades
{

    public function converterTemperatura($valor, $de, $para)
    {
        if ($de === 'C' && $para === 'F') {
            return $valor * 9 / 5 + 32;
        } elseif ($de === 'F' && $para === 'C') {
            return ($valor - 32) * 5 / 9;
        } elseif ($de === 'C' && $para === 'K') {
            return $valor + 273.15;
        } elseif ($de === 'K' && $para === 'C') {
            return $valor - 273.15;
        } else {
            throw new InvalidArgumentException("Conversão de temperatura inválida.");
        }
    }

    public function converterDistancia($valor, $de, $para)
    {
        $fatoresDeConversao = [
            'km' => 1000,
            'm' => 1,
            'cm' => 0.01,
            'mm' => 0.001,
        ];
        if (isset($fatoresDeConversao[$de]) && isset($fatoresDeConversao[$para])) {
            return $valor * $fatoresDeConversao[$de] / $fatoresDeConversao[$para];
        } else {
            throw new InvalidArgumentException("Conversão de distância inválida.");
        }
    }

    public function converterPeso($valor, $de, $para)
    {
        $fatoresDeConversao = [
            'kg' => 1,
            'g' => 0.001,
            'mg' => 0.000001,
            'lb' => 0.453592,
        ];
        if (isset($fatoresDeConversao[$de]) && isset($fatoresDeConversao[$para])) {
            return $valor * $fatoresDeConversao[$de] / $fatoresDeConversao[$para];
        } else {
            throw new InvalidArgumentException("Conversão de peso inválida.");
        }
    }

    public function converterVelocidade($valor, $de, $para)
    {
        $fatoresDeConversao = [
            'm/s' => 1,
            'km/h' => 3.6,
            'mph' => 2.23694,
            'ft/s' => 3.28084,
        ];
        if (isset($fatoresDeConversao[$de]) && isset($fatoresDeConversao[$para])) {
            return $valor * $fatoresDeConversao[$de] / $fatoresDeConversao[$para];
        } else {
            throw new InvalidArgumentException("Conversão de velocidade inválida.");
        }
    }

    public function converterVolume($valor, $de, $para)
    {
        $fatoresDeConversao = [
            'l' => 1,
            'ml' => 0.001,
            'm3' => 1000,
            'gal' => 3.78541,
        ];
        if (isset($fatoresDeConversao[$de]) && isset($fatoresDeConversao[$para])) {
            return $valor * $fatoresDeConversao[$de] / $fatoresDeConversao[$para];
        } else {
            throw new InvalidArgumentException("Conversão de volume inválida.");
        }
    }
}