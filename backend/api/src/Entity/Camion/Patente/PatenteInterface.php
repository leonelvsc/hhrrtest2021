<?php

namespace App\Entity\Camion\Patente;

interface PatenteInterface
{

    /**
     * La idea es que en el setter validen si es o no un string
     * que corresponde al tipo de patente
     * @var string
     */
    public string $dominio { get; }

    /**
     * Para saber si 2 patentes son del mismo tipo
     * @param PatenteInterface $patente
     * @return bool
     */
    public function is(PatenteInterface $patente): bool;
}