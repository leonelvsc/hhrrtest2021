<?php

namespace App\Entity\Viaje;

use App\Entity\Camion\HojaRutaInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\ReadableCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

// Lamentablemente no se puede declarar una herencia en doctrine con clases abstractas, todavía...
#[Entity]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'discr', type: 'string')]
#[DiscriminatorMap([
    'normal' => ViajeNormal::class,
    'prioritario' => ViajePrioritario::class,
    'devolucion' => ViajeDevolucion::class
])]
class BaseViaje implements ViajeInterface
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
     * @var HojaRutaInterface|null
     */
    #[ManyToOne(targetEntity: HojaRutaInterface::class, inversedBy: 'viajes')]
    public ?HojaRutaInterface $hojaRuta {
        get {
            return $this->hojaRuta;
        }
        set {
            $this->hojaRuta = $value;
        }
    }

    /**
     * @var Collection
     */
    #[OneToMany(targetEntity: PaqueteInterface::class, mappedBy: 'viaje')]
    private(set) ReadableCollection $paquetes {
        get {
            return $this->paquetes;
        }
        set {
            $this->paquetes = $value;
        }
    }

    /**
     * @var DireccionInterface|null
     */
    #[ManyToOne(targetEntity: DireccionInterface::class)]
    public ?DireccionInterface $origen {
        get {
            return $this->origen;
        }
        set {
            $this->origen = $value;
        }
    }

    /**
     * @var DireccionInterface|null
     */
    #[ManyToOne(targetEntity: DireccionInterface::class)]
    public ?DireccionInterface $destino {
        get {
            return $this->destino;
        }
        set {
            $this->destino = $value;
        }
    }

    /**
     *
     */
    public function __construct()
    {
        $this->paquetes = new ArrayCollection();
    }

    /**
     * @param PaqueteInterface $paquete
     * @return void
     */
    public function addPaquete(PaqueteInterface $paquete): void
    {
        $this->paquetes->add($paquete);
        $paquete->viaje = $this;
    }

    /**
     * @return float
     */
    public function calcularVolumen(): float
    {
        return $this->reducePaquetes(function(PaqueteInterface $paquete) {
            return $paquete->calcularVolumen();
        });
    }

    /**
     * @return float
     */
    public function calcularPeso(): float
    {
        return $this->reducePaquetes(function(PaqueteInterface $paquete) {
            return $paquete->getPeso();
        });
    }

    /**
     * @param \Closure $callback
     * @return float|mixed|null
     */
    private function reducePaquetes(\Closure $callback) {
        return $this->paquetes->reduce(function($sum, PaqueteInterface $paquete) use ($callback) {
            return $sum + $callback($paquete);
        }, 0.0);
    }

    /**
     * @return float
     */
    public function calcularDistancia(): float
    {
        return $this->destino->coordenada->calcularDistancia($this->origen->coordenada);
    }

    /**
     * Se pueden hacer 2 cosas o tiramos excepcion o no implementamos acá y movemos las interfaces abajo
     * @return float
     */
    public function calcularCosto(): float
    {
        throw new \BadMethodCallException("No se puede calcular el costo para este tipo de viaje");
    }
}
