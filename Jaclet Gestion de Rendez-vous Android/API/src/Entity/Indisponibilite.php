<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\IndisponibiliteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"insdisponibilite:read"}},
 *     denormalizationContext={"groups"={"insdisponibilite:write"}}
 * )
 * @ORM\Entity(repositoryClass=IndisponibiliteRepository::class)
 */
class Indisponibilite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
	 * @Groups({"insdisponibilite:read", "insdisponibilite:write"})
     * @ORM\Column(type="datetime")
     */
    private $date_heure_debut;

    /**
	 * @Groups({"insdisponibilite:read", "insdisponibilite:write"})
     * @ORM\Column(type="datetime")
     */
    private $date_heure_fin;

    /**
	 * @Groups({"insdisponibilite:read", "insdisponibilite:write"})
     * @ORM\Column(type="string", length=150)
     */
    private $motif;

    /**
	 * @Groups({"insdisponibilite:read", "insdisponibilite:write"})
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="indisponibilites")
     */
    private $medecin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeureDebut(): ?\DateTimeInterface
    {
        return $this->date_heure_debut;
    }

    public function setDateHeureDebut(\DateTimeInterface $date_heure_debut): self
    {
        $this->date_heure_debut = $date_heure_debut;

        return $this;
    }

    public function getDateHeureFin(): ?\DateTimeInterface
    {
        return $this->date_heure_fin;
    }

    public function setDateHeureFin(\DateTimeInterface $date_heure_fin): self
    {
        $this->date_heure_fin = $date_heure_fin;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getMedecin(): ?medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?medecin $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }
}
