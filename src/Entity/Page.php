<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\PageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PageRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(),],
    normalizationContext:['groups' => ['read::Page', 'read::Bloc_logo', 'read::Icone', 'read::Projet','read::Bloc_texte', 'read::Github' ], "enable_max_depth" => true],
    forceEager: false
)]
class Page
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read::Page'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Page'])]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read::Page'])]
    private ?string $sous_titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read::Page'])]
    private ?string $animateText = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read::Page'])]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: BlocLogo::class, inversedBy: 'bloc_texte_id')]
    #[Groups(['read::Page'])]
    private Collection $bloc_logo_id;

    #[ORM\ManyToMany(targetEntity: BlocTexte::class, inversedBy: 'pages')]
    #[Groups(['read::Page'])]
    private Collection $bloc_text_id;

    #[ORM\ManyToMany(targetEntity: Projet::class, inversedBy: 'pages')]
    #[Groups(['read::Page'])]
    private Collection $projet_id;

    #[ORM\ManyToMany(targetEntity: Github::class, mappedBy: 'github_id')]
    #[Groups(['read::Page'])]
    private Collection $githubs;

    public function __construct()
    {
        $this->bloc_logo_id = new ArrayCollection();
        $this->bloc_text_id = new ArrayCollection();
        $this->projet_id = new ArrayCollection();
        $this->githubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSousTitre(): ?string
    {
        return $this->sous_titre;
    }

    public function setSousTitre(?string $sous_titre): self
    {
        $this->sous_titre = $sous_titre;

        return $this;
    }

    public function getAnimateText(): ?string
    {
        return $this->animateText;
    }

    public function setAnimateText(?string $animateText): self
    {
        $this->animateText = $animateText;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, BlocLogo>
     */
    public function getBlocLogoId(): Collection
    {
        return $this->bloc_logo_id;
    }

    public function addBlocLogoId(BlocLogo $blocLogoId): self
    {
        if (!$this->bloc_logo_id->contains($blocLogoId)) {
            $this->bloc_logo_id->add($blocLogoId);
        }

        return $this;
    }

    public function removeBlocLogoId(BlocLogo $blocLogoId): self
    {
        $this->bloc_logo_id->removeElement($blocLogoId);

        return $this;
    }

    /**
     * @return Collection<int, BlocTexte>
     */
    public function getBlocTextId(): Collection
    {
        return $this->bloc_text_id;
    }

    public function addBlocTextId(BlocTexte $blocTextId): self
    {
        if (!$this->bloc_text_id->contains($blocTextId)) {
            $this->bloc_text_id->add($blocTextId);
        }

        return $this;
    }

    public function removeBlocTextId(BlocTexte $blocTextId): self
    {
        $this->bloc_text_id->removeElement($blocTextId);

        return $this;
    }

    /**
     * @return Collection<int, Projet>
     */
    public function getProjetId(): Collection
    {
        return $this->projet_id;
    }

    public function addProjetId(Projet $projetId): self
    {
        if (!$this->projet_id->contains($projetId)) {
            $this->projet_id->add($projetId);
        }

        return $this;
    }

    public function removeProjetId(Projet $projetId): self
    {
        $this->projet_id->removeElement($projetId);

        return $this;
    }

    public function __toString()
    {
        return $this->titre;
    }

    /**
     * @return Collection<int, Github>
     */
    public function getGithubs(): Collection
    {
        return $this->githubs;
    }

    public function addGithub(Github $github): self
    {
        if (!$this->githubs->contains($github)) {
            $this->githubs->add($github);
            $github->addGithubId($this);
        }

        return $this;
    }

    public function removeGithub(Github $github): self
    {
        if ($this->githubs->removeElement($github)) {
            $github->removeGithubId($this);
        }

        return $this;
    }
}
