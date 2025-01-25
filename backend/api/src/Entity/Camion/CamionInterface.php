<?php

namespace App\Entity\Camion;

use App\Entity\Camion\Patente\PatenteInterface;

interface CamionInterface
{
    /**
     * @var ModeloInterface
     */
    public ModeloInterface $modelo {get; set;}
    /**
     * @var PatenteInterface
     */
    public PatenteInterface $patente {get; set;}
    /**
     * @var HojaRutaInterface|null
     */
    public ?HojaRutaInterface $hojaRuta {get; set;}

    /**
     * @param HojaRutaInterface $hojaRuta
     * @return void
     */
    public function setHojaRuta(HojaRutaInterface $hojaRuta): void;
}