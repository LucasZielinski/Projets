<?php

namespace App\Entity;

use App\Repository\ConsultationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="datetime")
     */
    private $date_heure;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $motif;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $etat;

    /**
     * @ORM\Column(type="time")
     */
    private $duree;

    /**
     * @ORM\OneToMany(targetEntity=HistoriqueConsultation::class, mappedBy="la_consultation")
     */
    private $historique_consultations;

    /**
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="consultations")
     */
    private $medecin;

    /**
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
        return $this->date_heure;
    }

    public function setDateHeure(\DateTimeInterface $date_heure): self
    {
        $this->date_heure = $date_heure;

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
