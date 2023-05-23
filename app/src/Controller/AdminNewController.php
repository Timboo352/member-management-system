<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\MemberStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminNewController extends AbstractController
{
    #[Route('/admin/new/member', name: 'app_admin_new_member')]
    public function member(EntityManagerInterface $entityManager): Response
    {
        $member = new Member();
        $member->setStatus($entityManager->getRepository(MemberStatus::class)->find(2));
        $member->setFirstname("New");
        $member->setLastname("Member");

        $entityManager->persist($member);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_detail_member', ['memberId' => $member->getId()]);
    }
    #[Route('/admin/new/status', name: 'app_admin_new_status')]
    public function status(EntityManagerInterface $entityManager): Response
    {
        $status = new MemberStatus();
        $status->setColor("FFFFFF");
        $status->setTitle("New status");

        $entityManager->persist($status);
        $entityManager->flush();

        return $this->redirectToRoute('app_admin_detail_role', ['roleId' => $status->getId()]);
    }
}
