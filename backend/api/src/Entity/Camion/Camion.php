<?php

namespace App\Entity\Camion;

use App\Entity\Camion\Patente\PatenteInterface;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[Entity]
class Camion implements CamionInterface
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
     * @var PatenteInterface
     */
    #[ORM\OneToOne(targetEntity: PatenteInterface::class)]
    public PatenteInterface $patente {
        get {
            return $this->patente;
        }
        set {
            $this->patente = $value;
        }
    }

    /**
     * @var ModeloInterface
     */
    #[ORM\OneToOne(targetEntity: ModeloInterface::class)]
    public ModeloInterface $modelo {
        get {
            return $this->modelo;
        }
        set {
            $this->modelo = $value;
        }
    }

    /**
     * @var HojaRutaInterface|null
     */
    #[ORM\OneToOne(targetEntity: HojaRutaInterface::class)]
    public ?HojaRutaInterface $hojaRuta {
        get {
            return $this->hojaRuta;
        }
        set {
            if(!$this->modelo->puedoCargarHojaRuta($value)) {
                throw new \InvalidArgumentException("La hoja ruta no puede ser cargada en este camión");
            }

            $this->hojaRuta = $value;
        }
    }

    /**
     * @param HojaRutaInterface $hojaRuta
     * @return void
     */
    public function setHojaRuta(HojaRutaInterface $hojaRuta): void
    {
        $this->hojaRuta = $hojaRuta;
    }
}
