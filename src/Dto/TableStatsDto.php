<?php

namespace App\Dto;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    operations: [
        new GetCollection(
            uriTemplate: '/table_stats',
            normalizationContext: ['groups'=>['table_stats:item']],
            paginationEnabled: false,
        )
    ],
)]
/**
 * Route api/table_stats
 * TableStatsDto Collect stats of Table for each entity
*/
class TableStatsDto
{
    #[Groups(['table_stats:item'])]
    public int $id;

    #[Groups(['table_stats:item'])]
    public int $num;

    #[Groups(['table_stats:item'])]
    public int $maxGuests;

    #[Groups(['table_stats:item'])]
    public int $booking;

    #[Groups(['table_stats:item'])]
    public int $guestIsPresent;
}
