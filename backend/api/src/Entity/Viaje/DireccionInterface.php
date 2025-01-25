<?php

namespace App\Entity\Viaje;

use App\Entity\CoordenadaInterface;
use App\Entity\LocalidadInterface;
use App\Entity\PaisInterface;
use App\Entity\ProvinciaInterface;

interface DireccionInterface
{
    /**
     * @var string
     */
    public string $calle { get; set; }
    /**
     * @var string
     */
    public string $numero { get; set; }
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
     * @var CoordenadaInterface|null
     */
    public ?CoordenadaInterface $coordenada { get; set; }
}