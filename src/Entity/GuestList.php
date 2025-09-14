<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\QueryParameter;
use App\Repository\GuestListRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

#[ORM\Entity(repositoryClass: GuestListRepository::class)]
#[ApiResource(
    operations: [
    new Get(),
        new GetCollection(
            parameters: [
                'name' => new QueryParameter(
                    schema: ['type'=>'string'],
                    required: false,
                ),
                'isPresent'=>new QueryParameter(
                    schema: ['type'=>'boolean'],
                    required: false,
                )
            ]
        ),
    new Patch(),
    ]
)]
class GuestList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isPresent = null;

    #[ORM\ManyToOne(targetEntity: Table::class, inversedBy: 'guestLists')]
    #[JoinColumn(name: 'table_id', referencedColumnName: 'id', nullable: false)]
    private ?Table $tables = null;


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
