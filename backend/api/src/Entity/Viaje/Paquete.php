<?php

namespace App\Entity\Viaje;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
class Paquete implements PaqueteInterface
{
    /**
     * @var Uuid|null
     */
    #[Id]
    #[Column(type: UuidType::NAME, unique: true)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private(set) ?Uuid $id = null {
        get {
            return $this->id;
        }
    }

    /**
     * @var ViajeInterface
     */
    #[ManyToOne(targetEntity: ViajeInterface::class, inversedBy: 'paquetes')]
    public ViajeInterface $viaje {
        get {
            return $this->viaje;
        }
        set {
            $this->viaje = $value;
        }
    }

    /**
     * @param float $peso
     * @param float $alto
     * @param float $ancho
     * @param float $largo
     */
    public function __construct(
        #[Column(type: 'float')]
        public float $peso,

        #[Column(type: 'float')]
        public float $alto,

        #[Column(type: 'float')]
        public float $ancho,

        #[Column(type: 'float')]
        public float $largo,
    ) {
    }

    /**
     * @return float
     */
    public function calcularVolumen(): float
    {
        return $this->largo * $this->alto * $this->ancho;
    }

    /**
     * @return float
     */
    public function getPeso(): float
    {
        return $this->peso;
    }
}
