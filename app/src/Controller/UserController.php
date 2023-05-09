<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
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
