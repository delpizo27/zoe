<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Bplan", mappedBy="categories")
     */
    private $bplans;

    public function __construct()
    {
        $this->bplans = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|Bplan[]
     */
    public function getBplans(): Collection
    {
        return $this->bplans;
    }

    public function addBplan(Bplan $bplan): self
    {
        if (!$this->bplans->contains($bplan)) {
            $this->bplans[] = $bplan;
            $bplan->addCategory($this);
        }

        return $this;
    }

    public function removeBplan(Bplan $bplan): self
    {
        if ($this->bplans->contains($bplan)) {
            $this->bplans->removeElement($bplan);
            $bplan->removeCategory($this);
        }

        return $this;
    }
}
