<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EtatRepository")
 */
class Etat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $LIbelle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLIbelle(): ?string
    {
        return $this->LIbelle;
    }

    public function setLIbelle(string $LIbelle): self
    {
        $this->LIbelle = $LIbelle;

        return $this;
    }
}
