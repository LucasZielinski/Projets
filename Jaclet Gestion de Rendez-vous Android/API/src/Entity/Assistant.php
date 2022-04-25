<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\AssistantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"assistant:read"}},
 *     denormalizationContext={"groups"={"assistant:write"}}
 * )
 * @ORM\Entity(repositoryClass=AssistantRepository::class)
 */
class Assistant extends Utilisateur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
	 * @Groups({"assistant:read", "assistant:write"})
     * @ORM\ManyToOne(targetEntity=Medecin::class, inversedBy="assistants")
     */
    protected $medecin;

    public function getId(): ?int
    {
        return $this->id;
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
