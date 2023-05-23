<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\MemberStatus;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class InitController extends AbstractController
{
    #[Route('/init', name: 'app_init')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return new RedirectResponse('/login');
    }
}
