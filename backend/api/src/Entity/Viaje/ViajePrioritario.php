<?php

namespace App\Entity\Viaje;

use Doctrine\ORM\Mapping\Entity;

#[Entity]
class ViajePrioritario extends BaseViaje
{
    /**
     * @return float
     */
    public function calcularCosto(): float {
        $distancia = $this->calcularDistancia();

        $calculo1 = 4 * $this->calcularPeso() * $distancia;
        $calculo2 = 10 * $this->calcularVolumen() * $distancia;

        return ($calculo1 > $calculo2) ? $calculo1 : $calculo2;
    }
}
