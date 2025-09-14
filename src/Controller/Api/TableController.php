<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TableController extends AbstractController
{
    #[Route('/api/tables_stats', name: 'app_api_tables_stats', methods: ["GET"])]
    public function index(): Response
    {
        $stats = [];
        return $this->json($stats);
    }
}
