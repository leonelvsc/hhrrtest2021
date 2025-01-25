<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
class Pais implements PaisInterface
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
     * @var Collection|ArrayCollection
     */
    #[OneToMany(targetEntity: ProvinciaInterface::class, mappedBy: 'pais')]
    private(set) ReadableCollection $provincias {
        get {
            return $this->provincias;
        }
        set {
            $this->provincias = $value;
        }
    }

    /**
     * @param string $nombre
     */
    public function __construct(
        #[Column(type: 'string')]
        public string $nombre,
    ) {
        $this->provincias = new ArrayCollection();
    }
}
