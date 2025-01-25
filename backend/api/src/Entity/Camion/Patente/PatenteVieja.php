<?php

namespace App\Entity\Camion\Patente;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;


#[Entity]
final class PatenteVieja extends BasePatente implements PatenteInterface
{
    const string REGEX_PATENTE = '/^[a-z]{3}[0-9]{3}$/i';

    /**
     * @var string
     */
    #[Column(type: 'string')]
    private(set) string $dominio {
        get {
            return $this->dominio;
        }
        set {
            if(!preg_match(self::REGEX_PATENTE, $value)) {
                throw new \InvalidArgumentException("El dominio de patente debe tener formato AA123BB");
            }

            $this->dominio = $value;
        }
    }

    /**
     * @param string $dominio
     */
    public function __construct(
        string $dominio
    )
    {
        $this->dominio = $dominio;
    }

    /**
     * @param PatenteInterface $patente
     * @return bool
     */
    public function is(PatenteInterface $patente): bool
    {
        return $patente instanceof PatenteNueva;
    }
}