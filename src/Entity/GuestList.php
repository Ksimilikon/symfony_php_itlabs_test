<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\QueryParameter;
use App\Repository\GuestListRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: GuestListRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new Patch(),
        new GetCollection(
            uriTemplate: '/tables/{id}/guests',
            uriVariables: [
                'id'=>new Link(
                    fromClass: Table::class,
                    toProperty: 'tables'
                )
            ],
            normalizationContext: ['groups'=>['guest:list']] // TODO: why this route in example on Table and doc json is wrong
        )
    ],
    normalizationContext: ['groups'=>['guest:item', 'guest:list']]
)]
#[ApiFilter(SearchFilter::class, properties: ['name'=>SearchFilter::STRATEGY_PARTIAL])]
#[ApiFilter(BooleanFilter::class, properties: ["isPresent"])]
class GuestList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['guest:item', 'guest:list'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['guest:item', 'guest:list'])]
    private ?string $name = null;

    #[ORM\Column]
    #[Groups(['guest:item', 'guest:list'])]
    private ?bool $isPresent = null;

    #[ORM\ManyToOne(targetEntity: Table::class, inversedBy: 'guests')]
    #[JoinColumn(name: 'table_id', referencedColumnName: 'id', nullable: false)]
    #[Groups(['guest:item', 'guest:list'])]
    private ?Table $tables = null; // TODO: better $table (now $tables)


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function isPresent(): ?bool
    {
        return $this->isPresent;
    }

    public function setIsPresent(bool $isPresent): static
    {
        $this->isPresent = $isPresent;

        return $this;
    }

    public function getTables(): ?Table
    {
        return $this->tables;
    }

    public function setTables(?Table $tables): static
    {
        $this->tables = $tables;

        return $this;
    }

}
