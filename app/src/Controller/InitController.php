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
        $status = new MemberStatus();
        $member = new Member();
        $user = new User();

        $status->setTitle("Status");
        $status->setColor("ffffff");

        $member->setStatus($status);
        $member->setFirstname("First");
        $member->setLastname("Member");
        $member->setAuthUser($user);

        $user->setMember($member);
        $user->setPassword('$2y$13$LYAw9m6QEUHvhG0Zy5BEWOtjfA9RNNAUgWm558NlWmpyOIQ3N5EHu');
        $user->setRole('ROLE_ADMIN');


        $entityManager->persist($status);
        $entityManager->persist($user);
        $entityManager->persist($member);
        $entityManager->flush();
        return new RedirectResponse('/login');
    }
}
