<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\NumericFilter;
use ApiPlatform\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\QueryParameter;
use App\Dto\TableStatsDto;
use App\Repository\TableRepository;
use App\State\TableStatsDtoProvider;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Patch(),
        new GetCollection(
            provider: TableStatsDtoProvider::class,
            uriTemplate: '/table_stats',
            normalizationContext: ['groups'=>['table_stats:item']],
            output: TableStatsDto::class,
            paginationEnabled: false
        )
    ],
    normalizationContext: ['groups'=>['tables:item', 'tables:list']],
)]
#[ApiFilter(NumericFilter::class, properties: ['num'])]
class Table
{
    /**
    * One Table has many GuestList
    */
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['guest:item', 'guest:list', 'tables:item', 'tables:list'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['guest:item', 'guest:list', 'tables:item', 'tables:list'])]
    private ?int $num = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['guest:item', 'guest:list', 'tables:item', 'tables:list'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['guest:item', 'guest:list', 'tables:item', 'tables:list'])]
    private ?int $maxGuests = null;

    #[ORM\Column]
    #[Groups(['guest:item', 'guest:list', 'tables:item', 'tables:list'])]
    private ?int $guestsDef = null;

    #[ORM\Column]
    #[Groups(['guest:item', 'guest:list', 'tables:item', 'tables:list'])]
    private ?int $guestsNow = null;

    #[ORM\OneToMany(targetEntity: GuestList::class, mappedBy: 'tables')]
    #[Groups(['tables:item', 'tables:list'])]
    private Collection $guests;

    public function __construct()
    {
        $this->guests = new ArrayCollection();
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
    public function getGuests(): Collection
    {
        return $this->guests;
    }

    public function addGuest(GuestList $guest): static
    {
        if (!$this->guests->contains($guest)) {
            $this->guests->add($guest);
            $guest->setTables($this);
        }

        return $this;
    }

    public function removeGuest(GuestList $guest): static
    {
        if ($this->guests->removeElement($guest)) {
            // set the owning side to null (unless already changed)
            if ($guest->getTables() === $this) {
                $guest->setTables(null);
            }
        }

        return $this;
    }


}
