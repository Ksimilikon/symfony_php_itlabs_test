<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\QueryParameter;
use App\Repository\TableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Patch(),
    ]
)]
#[ApiResource(
    uriTemplate: 'tables/{id}/guests',
    operations: [new GetCollection()],
    uriVariables: [
        'id' => new Link(
            fromClass: Table::class,
            fromProperty: 'guests',
        )
    ]
)]
class Table
{
    /**
    * One Table has many GuestList
    */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $num = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $maxGuests = null;

    #[ORM\Column]
    private ?int $guestsDef = null;

    #[ORM\Column]
    private ?int $guestsNow = null;

    #[ORM\OneToMany(targetEntity: GuestList::class, mappedBy: 'tables')]
    private Collection $guestLists;

    public function __construct()
    {
        $this->guestLists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNum(): ?int
    {
        return $this->num;
    }

    public function setNum(int $num): static
    {
        $this->num = $num;

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

    public function getMaxGuests(): ?int
    {
        return $this->maxGuests;
    }

    public function setMaxGuests(int $maxGuests): static
    {
        $this->maxGuests = $maxGuests;

        return $this;
    }

    public function getGuestsDef(): ?int
    {
        return $this->guestsDef;
    }

    public function setGuestsDef(int $guestsDef): static
    {
        $this->guestsDef = $guestsDef;

        return $this;
    }

    public function getGuestsNow(): ?int
    {
        return $this->guestsNow;
    }

    public function setGuestsNow(int $guestsNow): static
    {
        $this->guestsNow = $guestsNow;

        return $this;
    }

    /**
     * @return Collection<int, GuestList>
     */
    public function getGuestLists(): Collection
    {
        return $this->guestLists;
    }

    public function addGuestList(GuestList $guestList): static
    {
        if (!$this->guestLists->contains($guestList)) {
            $this->guestLists->add($guestList);
            $guestList->setGuestLists($this);
        }

        return $this;
    }

    public function removeGuestList(GuestList $guestList): static
    {
        if ($this->guestLists->removeElement($guestList)) {
            // set the owning side to null (unless already changed)
            if ($guestList->getGuestLists() === $this) {
                $guestList->setGuestLists(null);
            }
        }

        return $this;
    }

}
