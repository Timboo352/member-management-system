<?php

namespace App\Controller;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDetailController extends AbstractController
{
    #[Route('/admin/detail/{memberId}', name: 'app_admin_detail_member')]
    public function members($memberId, EntityManagerInterface $entityManager): Response
    {
        $member = $entityManager->getRepository(Member::class)->find($memberId);
        return $this->render('admin_detail/member.html.twig', [
            'controller_name' => $member->getNickname(),
        ]);
    }
}
