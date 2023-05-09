<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        $member = $this->getUser()->getMember();
        return $this->render('user/index.html.twig', [
            'nickname' => $member->getNickname(),
            'firstname' => $member->getFirstname(),
            'lastname' => $member->getLastname(),
        ]);
    }
}
