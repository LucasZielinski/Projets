<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"consultation:read"}},
 *     denormalizationContext={"groups"={"consultation:write"}}
 * )
 * @ORM\Entity(repositoryClass=ConsultationRepository::class)
 */
class Consultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
	 * @Groups({"consultation:read", "consultation:write"})
     * @ORM\Column(type="datetime")
     */
    private $dateHeure;

    /**
	 * @Groups({"consultation:read", "consultation:write"})
     * @ORM\Column(type="string", length=150)
     */
    private $motif;

    /**
	 * @Groups({"consultation:read", "consultation:write"})
     * @ORM\Column(type="string", length=50)
     */
    private $etat;

    /**
	 * @Groups({"consultation:read", "consultation:write"})
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueConsultation::class, mappedBy="la_consultation")
     */
    private $historique_consultations;

    /**
	 * @Groups({"consultation:read", "consultation:write"})
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="consultations")
     */
    private $medecin;

    /**
	 * @Groups({"consultation:read", "consultation:write"})
     * @ORM\ManyToOne(targetEntity=Patient::class, inversedBy="consultations")
     */
    private $patient;

    public function __construct()
    {
        $this->historique_consultations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateHeure(): ?\DateTimeInterface
    {
        return $this->dateHeure;
    }

    public function setDateHeure(\DateTimeInterface $dateHeure): self
    {
        $this->dateHeure = $dateHeure;

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

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection|HistoriqueConsultation[]
     */
    public function getHistoriqueConsultations(): Collection
    {
        return $this->historique_consultations;
    }

    public function addHistoriqueConsultation(HistoriqueConsultation $historiqueConsultation): self
    {
        if (!$this->historique_consultations->contains($historiqueConsultation)) {
            $this->historique_consultations[] = $historiqueConsultation;
            $historiqueConsultation->setLaConsultation($this);
        }

        return $this;
    }

    public function removeHistoriqueConsultation(HistoriqueConsultation $historiqueConsultation): self
    {
        if ($this->historique_consultations->removeElement($historiqueConsultation)) {
            // set the owning side to null (unless already changed)
            if ($historiqueConsultation->getLaConsultation() === $this) {
                $historiqueConsultation->setLaConsultation(null);
            }
        }

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

    public function getPatient(): ?patient
    {
        return $this->patient;
    }

    public function setPatient(?patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }
}
