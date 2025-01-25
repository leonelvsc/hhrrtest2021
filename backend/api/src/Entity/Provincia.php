<?php

namespace App\Entity;

use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
class Provincia implements ProvinciaInterface
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
     * @var PaisInterface
     */
    #[ManyToOne(targetEntity: PaisInterface::class, inversedBy: 'provincias')]
    public PaisInterface $pais {
        get {
            return $this->pais;
        }
        set {
            $this->pais = $value;
        }
    }

    /**
     * @var Collection
     */
    #[OneToMany(targetEntity: LocalidadInterface::class, mappedBy: 'provincia')]
    private(set) ReadableCollection $localidades {
        get {
            return $this->localidades;
        }
        set {
            $this->localidades = $value;
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