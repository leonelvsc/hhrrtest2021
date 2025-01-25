<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
class Localidad implements LocalidadInterface
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
     * @var ProvinciaInterface
     */
    #[ManyToOne(targetEntity: ProvinciaInterface::class, inversedBy: 'localidades')]
    public ProvinciaInterface $provincia {
        get {
            return $this->provincia;
        }
        set {
            $this->provincia = $value;
        }
    }

    /**
     * @param string $nombre
     */
    public function __construct(
        #[Column(type: 'string')]
        public string $nombre,
    ) {

    }
}
