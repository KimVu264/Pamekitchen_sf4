<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;


/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 *  @Vich\Uploadable
 */

class Recette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_pers;

    /**
     * @ORM\Column(type="integer")
     */
    private $tps_total;

    /**
     * @ORM\Column(type="integer")
     */
    private $tps_cuisson;

    /**
     * @ORM\Column(type="integer")
     */
    private $tps_prepare;

    /**
     * @ORM\Column(type="text")
     */
    private $preparation;

    /**
     * @ORM\Column(type="string")
     */
    private $brochure;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;


    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="recette", orphanRemoval=true, cascade={"persist"})
     */
    private $ingredients;

    /**
     * @ORM\OneToMany(targetEntity=Ustensile::class, mappedBy="recette", orphanRemoval=true, cascade={"persist"})
     */
    private $ustensiles;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recettes")
     */
    private $user;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->ustensiles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbrPers(): ?int
    {
        return $this->nbr_pers;
    }

    public function setNbrPers(int $nbr_pers): self
    {
        $this->nbr_pers = $nbr_pers;

        return $this;
    }

    public function getTpsTotal(): ?int
    {
        return $this->tps_total;
    }

    public function setTpsTotal(int $tps_total): self
    {
        $this->tps_total = $tps_total;

        return $this;
    }

    public function getTpsCuisson(): ?int
    {
        return $this->tps_cuisson;
    }

    public function setTpsCuisson(int $tps_cuisson): self
    {
        $this->tps_cuisson = $tps_cuisson;

        return $this;
    }

    public function getTpsPrepare(): ?int
    {
        return $this->tps_prepare;
    }

    public function setTpsPrepare(int $tps_prepare): self
    {
        $this->tps_prepare = $tps_prepare;

        return $this;
    }

  
    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(string $preparation): self
    {
        $this->preparation = $preparation;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->setRecette($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecette() === $this) {
                $ingredient->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ustensile[]
     */
    public function getUstensiles(): Collection
    {
        return $this->ustensiles;
    }

    public function addUstensile(Ustensile $ustensile): self
    {
        if (!$this->ustensiles->contains($ustensile)) {
            $this->ustensiles[] = $ustensile;
            $ustensile->setRecette($this);
        }

        return $this;
    }

    public function removeUstensile(Ustensile $ustensile): self
    {
        if ($this->ustensiles->removeElement($ustensile)) {
            // set the owning side to null (unless already changed)
            if ($ustensile->getRecette() === $this) {
                $ustensile->setRecette(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get the value of brochure
     */ 
    public function getBrochure()
    {
        return $this->brochure;
    }

    /**
     * Set the value of brochure
     *
     * @return  self
     */ 
    public function setBrochure($brochure)
    {
        $this->brochure = $brochure;

        return $this;
    }
    

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }
}
