<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column]
    private ?int $nb_place_dispo = null;

    #[ORM\Column]
    private ?int $org_id = null;

    /**
     * @var Collection<int, Reserv>
     */
    #[ORM\OneToMany(targetEntity: Reserv::class, mappedBy: 'Event')]
    private Collection $reservs;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?user $organisateur = null;

    public function __construct()
    {
        $this->reservs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getNbPlaceDispo(): ?int
    {
        return $this->nb_place_dispo;
    }

    public function setNbPlaceDispo(int $nb_place_dispo): static
    {
        $this->nb_place_dispo = $nb_place_dispo;

        return $this;
    }

    public function getOrgId(): ?int
    {
        return $this->org_id;
    }

    public function setOrgId(int $org_id): static
    {
        $this->org_id = $org_id;

        return $this;
    }

    /**
     * @return Collection<int, Reserv>
     */
    public function getReservs(): Collection
    {
        return $this->reservs;
    }

    public function addReserv(Reserv $reserv): static
    {
        if (!$this->reservs->contains($reserv)) {
            $this->reservs->add($reserv);
            $reserv->setEvent($this);
        }

        return $this;
    }

    public function removeReserv(Reserv $reserv): static
    {
        if ($this->reservs->removeElement($reserv)) {
            // set the owning side to null (unless already changed)
            if ($reserv->getEvent() === $this) {
                $reserv->setEvent(null);
            }
        }

        return $this;
    }

    public function getOrganisateur(): ?user
    {
        return $this->organisateur;
    }

    public function setOrganisateur(?user $organisateur): static
    {
        $this->organisateur = $organisateur;

        return $this;
    }
}
