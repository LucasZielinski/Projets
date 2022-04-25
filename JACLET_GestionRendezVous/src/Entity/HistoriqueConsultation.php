<?php

namespace App\Entity;

use App\Repository\HistoriqueConsultationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistoriqueConsultationRepository::class)
 */
class HistoriqueConsultation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=consultation::class, inversedBy="historique_consultations")
     */
    private $la_consultation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLaConsultation(): ?consultation
    {
        return $this->la_consultation;
    }

    public function setLaConsultation(?consultation $la_consultation): self
    {
        $this->la_consultation = $la_consultation;

        return $this;
    }
}
