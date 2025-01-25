<?php

namespace App\Entity\Camion\Patente;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\CustomIdGenerator;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

/**
 * *Aclaración*: acá usaría normalmente una clase abstracta
 * doctrine no deja que en herencia haya una clase abstracta, por eso no es abstracta esta clase
 * sino implementaría esta clase la interfaz
 */
#[Entity]
#[InheritanceType('SINGLE_TABLE')]
#[DiscriminatorColumn(name: 'discr', type: 'string')]
#[DiscriminatorMap(['nueva' => PatenteNueva::class, 'vieja' => PatenteVieja::class])]
class BasePatente
{
    /**
     * @var Uuid|null
     */
    #[Id]
    #[Column(type: UuidType::NAME, unique: true)]
    #[GeneratedValue(strategy: 'CUSTOM')]
    #[CustomIdGenerator(class: 'doctrine.uuid_generator')]
    protected(set) ?Uuid $id = null {
        get {
            return $this->id;
        }
    }

    public function is(PatenteInterface $patente): bool
    {
        throw new \BadMethodCallException("Metodo no implementado");
    }
}