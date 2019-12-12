<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneFraisHorsForfaitRepository")
 */
class LigneFraisHorsForfait
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
    private $libelle;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montant;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FicheFrais")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fichefrais;

    

    public function getId(): ?int
    {
        return $this->id;
    }

   
    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getFichefrais(): ?FicheFrais
    {
        return $this->fichefrais;
    }

    public function setFichefrais(?FicheFrais $fichefrais): self
    {
        $this->fichefrais = $fichefrais;

        return $this;
    }

    
}
