<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\BlocLogoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BlocLogoRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection()]
)]
class BlocLogo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read::Bloc_logo'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Bloc_logo'])]
    private ?string $nom_bloc = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Bloc_logo'])]
    private ?string $titre = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['read::Bloc_logo'])]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Icone::class, inversedBy: 'blocLogos')]
    #[Groups(['read::Bloc_logo'])]
    private Collection $icone_id;

    #[ORM\ManyToMany(targetEntity: Page::class, mappedBy: 'bloc_logo_id')]
    private Collection $bloc_texte_id;

    public function __construct()
    {
        $this->icone_id = new ArrayCollection();
        $this->bloc_texte_id = new ArrayCollection();
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
     * @return Collection<int, Icone>
     */
    public function getIconeId(): Collection
    {
        return $this->icone_id;
    }

    public function addIconeId(Icone $iconeId): self
    {
        if (!$this->icone_id->contains($iconeId)) {
            $this->icone_id->add($iconeId);
        }

        return $this;
    }

    public function removeIconeId(Icone $iconeId): self
    {
        $this->icone_id->removeElement($iconeId);

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getBlocTexteId(): Collection
    {
        return $this->bloc_texte_id;
    }

    public function addBlocTexteId(Page $blocTexteId): self
    {
        if (!$this->bloc_texte_id->contains($blocTexteId)) {
            $this->bloc_texte_id->add($blocTexteId);
            $blocTexteId->addBlocLogoId($this);
        }

        return $this;
    }

    public function removeBlocTexteId(Page $blocTexteId): self
    {
        if ($this->bloc_texte_id->removeElement($blocTexteId)) {
            $blocTexteId->removeBlocLogoId($this);
        }

        return $this;
    }

    public function __toString(){
        return $this->nom_bloc;
    }
}
