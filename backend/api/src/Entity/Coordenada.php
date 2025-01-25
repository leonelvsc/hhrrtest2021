<?php

namespace App\Entity;

use App\Repository\CoordenadaRepository;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
class Coordenada implements CoordenadaInterface
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
     * @param float $latitud
     * @param float $longitud
     * @param PaisInterface $pais
     * @param ProvinciaInterface $provincia
     * @param LocalidadInterface $localidad
     */
    public function __construct(
        #[Column(type: 'float')]
        public float $latitud,
        #[Column(type: 'float')]
        public float $longitud,
        #[ManyToOne(targetEntity: PaisInterface::class)]
        public PaisInterface $pais,
        #[ManyToOne(targetEntity: ProvinciaInterface::class)]
        public ProvinciaInterface $provincia,
        #[ManyToOne(targetEntity: LocalidadInterface::class)]
        public LocalidadInterface $localidad,
    ) {
    }


    /**
     * @param CoordenadaInterface $coordenada
     * @return float
     */
    public function calcularDistancia(CoordenadaInterface $coordenada): float
    {
        $theta = $this->longitud - $coordenada->longitud;
        $distance = (sin(deg2rad($this->latitud)) * sin(deg2rad($coordenada->latitud))) + (cos(deg2rad($this->latitud)) * cos(deg2rad($coordenada->latitud)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;
        $distance = $distance * 1.609344;
        return (round($distance,2));
    }
}
