<?php

namespace App\Entity\Camion;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

/**
 *
 */
#[Entity]
class Modelo implements ModeloInterface
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
     * @param string $nombre
     * @param float $volumenMaximo
     * @param float $pesoMaximo
     */
    public function __construct(
        #[Column(type: 'string')]
        public readonly string $nombre,

        #[Column(type: 'float')]
        public readonly float $volumenMaximo,

        #[Column(type: 'float')]
        public readonly float $pesoMaximo
    )
    {
    }


    /**
     * @param HojaRutaInterface $hojaRuta
     * @return bool
     */
    public function puedoCargarHojaRuta(HojaRutaInterface $hojaRuta): bool
    {
        if(
            $hojaRuta->calcularVolumen() > $this->volumenMaximo
            || $hojaRuta->calcularPeso() > $this->pesoMaximo
        ) {
            return false;
        }

        return true;
    }
}
