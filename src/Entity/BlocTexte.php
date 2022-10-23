<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\BlocTexteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BlocTexteRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection()
])]
class BlocTexte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read::Bloc_texte'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Bloc_texte'])]
    private ?string $nom_bloc = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Bloc_texte'])]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read::Bloc_texte'])]
    private ?string $image = null;

    #[ORM\Column(length: 2040, nullable: true)]
    #[Groups(['read::Bloc_texte'])]
    private ?string $sous_titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read::Bloc_texte'])]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Page::class, mappedBy: 'bloc_text_id')]
    private Collection $pages;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomBloc(): ?string
    {
        return $this->nom_bloc;
    }

    public function setNomBloc(string $nom_bloc): self
    {
        $this->nom_bloc = $nom_bloc;

        return $this;
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): self
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
            $page->addBlocTextId($this);
        }

        return $this;
    }

    public function removePage(Page $page): self
    {
        if ($this->pages->removeElement($page)) {
            $page->removeBlocTextId($this);
        }

        return $this;
    }
}
