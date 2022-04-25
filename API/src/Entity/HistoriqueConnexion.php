<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HistoriqueConnexionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"historiqueConnexion:read"}},
 *     denormalizationContext={"groups"={"historiqueConnexion:write"}}
 * )
 * @ORM\Entity(repositoryClass=HistoriqueConnexionRepository::class)
 */
class HistoriqueConnexion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
	 * @Groups({"historiqueConnexion:read", "historiqueConnexion:write"})
     * @ORM\Column(type="datetime")
     */
    private $date_heure;

    /**
	 * @Groups({"historiqueConnexion:read", "historiqueConnexion:write"})
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="historiqueConnexions")
     */
    private $utilisateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->date_heure;
    }

    public function setDateHeure(\DateTimeInterface $date_heure): self
    {
        $this->date_heure = $date_heure;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }
}
