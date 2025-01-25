<?php

namespace App\Entity\Camion;

use App\Entity\Viaje\ViajeInterface;
use Doctrine\Common\Collections\ArrayCollection;
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
class HojaRuta implements HojaRutaInterface
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
    #[ManyToOne(targetEntity: HojaRutaInterface::class, inversedBy: 'hojaRutas')]
    public ?HojaRutaInterface $hojaRutaPadre {
        get {
            return $this->hojaRutaPadre;
        }
        set {
            $this->hojaRutaPadre = $value;
        }
    }

    /**
     * @var ReadableCollection<int, HojaRutaInterface>
     */
    #[OneToMany(targetEntity: HojaRutaInterface::class, mappedBy: 'hojaRutaPadre')]
    private(set) ReadableCollection $hojaRutas {
        get {
            return $this->hojaRutas;
        }
        set {
            $this->hojaRutas = $value;
        }
    }

    /**
     * @var ReadableCollection<int, ViajeInterface>
     */
    #[OneToMany(targetEntity: ViajeInterface::class, mappedBy: 'hojaRuta')]
    private(set) ReadableCollection $viajes {
        get {
            return $this->viajes;
        }
        set {
            $this->viajes = $value;
        }
    }

    /**
     *
     */
    public function __construct() {
        $this->hojaRutas = new ArrayCollection();
        $this->viajes = new ArrayCollection();
    }


    /**
     * @return float
     */
    public function calcularVolumen(): float
    {
        return $this->reduceViajes(function(ViajeInterface $viaje) {
            return $viaje->calcularVolumen();
        });
    }

    /**
     * @return float
     */
    public function calcularPeso(): float
    {
        return $this->reduceViajes(function(ViajeInterface $viaje) {
            return $viaje->calcularPeso();
        });
    }

    /**
     * @return float
     */
    public function calcularCosto(): float
    {
        return $this->reduceViajes(function(ViajeInterface $viaje) {
            return $viaje->calcularCosto();
        });
    }

    /**
     * @param \Closure $callback
     * @return float|mixed|null
     */
    private function reduceViajes(\Closure $callback) {
        return $this->viajes->reduce(function($sum, ViajeInterface $viaje) use ($callback) {
            return $sum + $callback($viaje);
        }, 0.0);
    }

    /**
     * @param HojaRutaInterface $hojaRuta
     * @return void
     */
    public function addHojaRuta(HojaRutaInterface $hojaRuta): void
    {
        $this->hojaRutas->add($hojaRuta);
        $hojaRuta->hojaRutaPadre = $this;
    }

    /**
     * @param ViajeInterface $viaje
     * @return void
     */
    public function addViaje(ViajeInterface $viaje): void
    {
        $this->viajes->add($viaje);
        $viaje->hojaRuta = $this;
    }
}
