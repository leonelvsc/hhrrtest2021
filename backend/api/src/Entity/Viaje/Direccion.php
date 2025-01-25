<?php

namespace App\Entity\Viaje;

use App\Entity\CoordenadaInterface;
use App\Entity\LocalidadInterface;
use App\Entity\PaisInterface;
use App\Entity\ProvinciaInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
class Direccion implements DireccionInterface
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
     * @param string $calle
     * @param string $numero
     * @param PaisInterface $pais
     * @param ProvinciaInterface $provincia
     * @param LocalidadInterface $localidad
     * @param CoordenadaInterface|null $coordenada
     */
    public function __construct(
        #[Column(type: 'string')]
        public string $calle,
        #[Column(type: 'string')]
        public string $numero,
        #[ManyToOne(targetEntity: PaisInterface::class)]
        public PaisInterface $pais,
        #[ManyToOne(targetEntity: ProvinciaInterface::class)]
        public ProvinciaInterface $provincia,
        #[ManyToOne(targetEntity: LocalidadInterface::class)]
        public LocalidadInterface $localidad,
        #[ManyToOne(targetEntity: CoordenadaInterface::class)]
        public ?CoordenadaInterface $coordenada = null
    )
    {
    }
}
