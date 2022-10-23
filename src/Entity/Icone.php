<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\IconeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: IconeRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection()
])]
class Icone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read::Icone'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Icone'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Icone'])]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read::Icone'])]
    private ?string $lien = null;

    #[ORM\ManyToMany(targetEntity: BlocLogo::class, mappedBy: 'icone_id')]
    private Collection $blocLogos;

    #[ORM\ManyToMany(targetEntity: Footer::class, mappedBy: 'icone_id')]
    private Collection $footers;

    public function __construct()
    {
        $this->blocLogos = new ArrayCollection();
        $this->footers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        var_dump($this);
        die;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * @return Collection<int, BlocLogo>
     */
    public function getBlocLogos(): Collection
    {
        return $this->blocLogos;
    }

    public function addBlocLogo(BlocLogo $blocLogo): self
    {
        if (!$this->blocLogos->contains($blocLogo)) {
            $this->blocLogos->add($blocLogo);
            $blocLogo->addIconeId($this);
        }

        return $this;
    }

    public function removeBlocLogo(BlocLogo $blocLogo): self
    {
        if ($this->blocLogos->removeElement($blocLogo)) {
            $blocLogo->removeIconeId($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Footer>
     */
    public function getFooters(): Collection
    {
        return $this->footers;
    }

    public function addFooter(Footer $footer): self
    {
        if (!$this->footers->contains($footer)) {
            $this->footers->add($footer);
            $footer->addIconeId($this);
        }

        return $this;
    }

    public function removeFooter(Footer $footer): self
    {
        if ($this->footers->removeElement($footer)) {
            $footer->removeIconeId($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->nom;
    }

}
