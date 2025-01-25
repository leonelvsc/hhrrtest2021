<?php

namespace App\Entity\Camion;

use App\Entity\Viaje\ViajeInterface;
use Doctrine\Common\Collections\ReadableCollection;

interface HojaRutaInterface
{
    /**
     * @var HojaRutaInterface|null
     */
    public ?HojaRutaInterface $hojaRutaPadre { get; set; }

    /**
     * @var ReadableCollection<int, HojaRutaInterface>
     */
    public ReadableCollection$hojaRutas { get; }

    /**
     * @var ReadableCollection<int, ViajeInterface>
     */
    public ReadableCollection$viajes { get; }

    /**
     * @return float
     */
    public function calcularVolumen(): float;

    /**
     * @return float
     */
    public function calcularPeso(): float;

    /**
     * @return float
     */
    public function calcularCosto(): float;
}