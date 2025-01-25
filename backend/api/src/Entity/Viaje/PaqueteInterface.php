<?php

namespace App\Entity\Viaje;

interface PaqueteInterface
{
    /**
     * @var ViajeInterface
     */
    public ViajeInterface $viaje { get; set; }

    /**
     * @return float
     */
    public function calcularVolumen(): float;

    /**
     * @return float
     */
    public function getPeso(): float;
}