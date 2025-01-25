<?php

namespace App\Entity;

interface CoordenadaInterface
{
    /**
     * @var float
     */
    public float $latitud { get; set; }
    /**
     * @var float
     */
    public float $longitud { get; set; }
    /**
     * @var PaisInterface
     */
    public PaisInterface $pais { get; set; }
    /**
     * @var ProvinciaInterface
     */
    public ProvinciaInterface $provincia { get; set; }
    /**
     * @var LocalidadInterface
     */
    public LocalidadInterface $localidad { get; set; }

    /**
     * @param CoordenadaInterface $coordenada
     * @return float
     */
    public function calcularDistancia(CoordenadaInterface $coordenada): float;
}