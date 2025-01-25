<?php

namespace App\Entity\Viaje;

use App\Entity\Camion\HojaRutaInterface;
use Doctrine\Common\Collections\ReadableCollection;

interface ViajeInterface
{
    /**
     * @var HojaRutaInterface|null
     */
    public ?HojaRutaInterface $hojaRuta { get; set; }

    /**
     * @var Collection
     */
    public ReadableCollection $paquetes { get; }
    public DireccionInterface $origen { get; }
    public DireccionInterface $destino { get; }

    /**
     * @return float
     */
    public function calcularCosto(): float;

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
    public function calcularDistancia(): float;
}