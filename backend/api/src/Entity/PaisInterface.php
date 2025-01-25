<?php

namespace App\Entity;

use Doctrine\Common\Collections\ReadableCollection;

interface PaisInterface
{
    /**
     * @var string
     */
    public string $nombre { get; set; }

    /**
     * @var Collection
     */
    public ReadableCollection$provincias { get; }
}