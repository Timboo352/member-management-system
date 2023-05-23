<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\MemberStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDeleteController extends AbstractController
{
    #[Route('/admin/member/delete/{memberId}', name: 'app_admin_member_delete')]
    public function member($memberId, EntityManagerInterface $entityManager): Response
    {
        $delete = $entityManager->getRepository(Member::class)->find($memberId);

        try {
            $entityManager->remove($delete);
            $entityManager->flush();
        } catch (\Exception $e) {
            return $this->redirectToRoute('app_admin_detail_member', ['memberId' => $memberId]);
        }
        return $this->redirectToRoute('app_admin_overview_members');
    }

    #[Route('/admin/status/delete/{statusId}', name: 'app_admin_status_delete')]
    public function status($statusId, EntityManagerInterface $entityManager): Response
    {
        if($statusId == 2) {
            return $this->redirectToRoute('app_admin_detail_role', ['roleId' => $statusId]);
        }
        $delete = $entityManager->getRepository(MemberStatus::class)->find($statusId);

        try {
            $entityManager->remove($delete);
            $entityManager->flush();
        } catch (\Exception $e) {
            return $this->redirectToRoute('app_admin_detail_role', ['roleId' => $statusId]);
        }

        return $this->redirectToRoute('app_admin_overview_roles');
    }
}
