<?php

namespace App\State;

use ApiPlatform\Metadata\CollectionOperationInterface;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Dto\TableStatsDto;
use App\Entity\Table;
use Doctrine\ORM\EntityManagerInterface;

class TableStatsDtoProvider implements ProviderInterface
{
    public function __construct(
        private readonly EntityManagerInterface $em
    ){}
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): null|iterable
    {
        if (!$operation instanceof CollectionOperationInterface) {
            return null;
        }
        $filterNum=$context['filters']['num'] ?? null;

        $query = $this->em->createQueryBuilder()
            ->select('t.id', 't.num', 't.maxGuests')
            ->addSelect('COUNT(gl.id) AS booking')
            ->addSelect('SUM(CASE WHEN gl.isPresent = true THEN 1 ELSE 0 END) AS guestsIsPresent')
            ->from(Table::class, 't')
            ->leftJoin('t.guests', 'gl')
            ->groupBy('t.id');
        if ($filterNum != null) {
            $query->andWhere('t.num = :num')
                ->setParameter('num', (int) $filterNum);
        }
        $rows = $query->getQuery()->getArrayResult();
        foreach ($rows as $r) {
            $dto = new TableStatsDto();
            $dto->id              = (int) $r['id'];
            $dto->num             = (int) $r['num'];
            $dto->maxGuests       = (int) $r['maxGuests'];
            $dto->booking         = (int) $r['booking'];
            $dto->guestsIsPresent = (int) $r['guestsIsPresent'];
            yield $dto;
        }
    }
}
