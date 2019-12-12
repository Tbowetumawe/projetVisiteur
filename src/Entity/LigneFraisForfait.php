<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LigneFraisForfaitRepository")
 */
class LigneFraisForfait
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
    private $mois;

    

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FicheFrais")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fichefrais;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\FraisForfait")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fraisforfait;

    
  
    public function getId(): ?int
    {
        return $this->id;
    }

    
    public function getMois(): ?string
    {
        return $this->mois;
    }

    public function setMois(string $mois): self
    {
        $this->mois = $mois;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getFichefrais(): ?FicheFrais
    {
        return $this->fichefrais;
    }

    public function setFichefrais(FicheFrais $fichefrais): self
    {
        $this->fichefrais = $fichefrais;

        return $this;
    }

 
    public function getFraisforfait(): ?FraisForfait
    {
        return $this->fraisforfait;
    }

    public function setFraisforfait(FraisForfait $fraisforfait): self
    {
        $this->fraisforfait = $fraisforfait;

        return $this;
    }

    
   
     

    

    
}
