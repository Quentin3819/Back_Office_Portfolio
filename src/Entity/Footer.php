<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\FooterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: FooterRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection(),],
    normalizationContext:['groups' => ['read::Icone', 'read::Footer'], "enable_max_depth" => true],
    forceEager: false
)]
class Footer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read::Footer'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Footer'])]
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Footer'])]
    private ?string $copyright = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Footer'])]
    private ?string $titre = null;

    #[ORM\ManyToMany(targetEntity: Icone::class, inversedBy: 'footers')]
    #[Groups(['read::Footer'])]
    private Collection $icone_id;

    public function __construct()
    {
        $this->icone_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(string $copyright): self
    {
        $this->copyright = $copyright;

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

    public function __toString(){
        return $this->titre;
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
}
