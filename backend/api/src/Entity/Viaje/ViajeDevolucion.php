<?php

namespace App\Entity\Viaje;

use Doctrine\ORM\Mapping\Entity;

#[Entity]
class ViajeDevolucion extends BaseViaje
{
    /**
     * @return float
     */
    public function calcularCosto(): float {
        return 1000.00;
    }
}
