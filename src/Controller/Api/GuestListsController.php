<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GuestListsController extends AbstractController
{
    #[Route('/api/guest/lists', name: 'app_api_guest_lists')]
    public function index(): Response
    {
        return $this->json(0);
    }
}
