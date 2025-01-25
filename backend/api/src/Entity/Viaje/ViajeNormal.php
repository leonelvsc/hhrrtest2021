<?php

namespace App\Entity\Viaje;

use Doctrine\ORM\Mapping\Entity;

#[Entity]
class ViajeNormal extends BaseViaje
{
    /**
     * @return float
     */
    public function calcularCosto(): float {
        return 2 * $this->calcularPeso() * $this->calcularDistancia();
    }
}
