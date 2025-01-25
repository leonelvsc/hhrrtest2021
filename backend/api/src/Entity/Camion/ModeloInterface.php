<?php

namespace App\Entity\Camion;

/**
 *
 */
interface ModeloInterface
{
    /**
     * @param HojaRutaInterface $hojaRuta
     * @return bool
     */
    public function puedoCargarHojaRuta(HojaRutaInterface $hojaRuta): bool;
}