<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\HistoriqueConsultationRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"historiqueConsultation:read"}},
 *     denormalizationContext={"groups"={"historiqueConsultation:write"}}
 * )
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
	 * @Groups({"historiqueConsultation:read", "historiqueConsultation:write"})
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
