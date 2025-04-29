<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(): Response
    {
        // This method intentionally left blank.
        // The `AuthLogin` authenticator will handle the authentication process.
    }
}