<?php

namespace App\Entity;

interface LocalidadInterface
{
    /**
     * @var ProvinciaInterface
     */
    public ProvinciaInterface $provincia { get; set; }

    /**
     * @var string
     */
    public string $nombre { get; set; }
}