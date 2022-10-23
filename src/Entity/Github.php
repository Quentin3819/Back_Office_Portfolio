<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\GithubRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GithubRepository::class)]
#[ApiResource(operations: [
    new Get(),
    new GetCollection()
])]
class Github
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read::Github'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read::Github'])]
    private ?string $nom_utilisateur = null;

    #[ORM\ManyToMany(targetEntity: Page::class, inversedBy: 'githubs')]
    #[Groups(['read::Github'])]
    private Collection $github_id;

    public function __construct()
    {
        $this->github_id = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): self
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getGithubId(): Collection
    {
        return $this->github_id;
    }

    public function addGithubId(Page $githubId): self
    {
        if (!$this->github_id->contains($githubId)) {
            $this->github_id->add($githubId);
        }

        return $this;
    }

    public function removeGithubId(Page $githubId): self
    {
        $this->github_id->removeElement($githubId);

        return $this;
    }
}
