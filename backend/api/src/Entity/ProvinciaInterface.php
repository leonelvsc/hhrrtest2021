<?php

namespace App\Entity;

use Doctrine\Common\Collections\ReadableCollection;

interface ProvinciaInterface
{
    /**
     * @var PaisInterface
     */
    public PaisInterface $pais { get; set; }

    /**
     * @var string
     */
    public string $nombre { get; set; }

    /**
     * @var Collection
     */
    public ReadableCollection$localidades { get; }
}