<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\MemberStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDetailController extends AbstractController
{
    #[Route('/admin/detail/member/{memberId}', name: 'app_admin_detail_member')]
    public function members($memberId, EntityManagerInterface $entityManager): Response
    {
        $member = $entityManager->getRepository(Member::class)->find($memberId);

        $repository = $entityManager->getRepository(MemberStatus::class);

        $queryBuilder = $repository->createQueryBuilder('e')
            ->orderBy('e.title', 'ASC'); // Sorting by lastname in ascending order

        $query = $queryBuilder->getQuery();
        $status = $query->getResult();
        $parsedStatus = $statusIds = [];
        foreach ($status as $i) {
            $parsedStatus[$i->getId()] = $i->getTitle();
            $statusIds[] = $i->getId();
        }

        if(isset($_POST['user'])) {
            $F = [];
            foreach ($_POST['user'] as $k => $v) {
                if(strlen($v)) {
                    $F[$k] = $v;
                }
            }
            if(isset($F['firstname'])) {
                $member->setFirstname($F['firstname']);
            }
            if(isset($F['lastname'])) {
                $member->setLastname($F['lastname']);
            }
            if(isset($F['email'])) {
                $member->setEmail($F['email']);
            }
            if(isset($F['nickname'])) {
                $member->setNickname($F['nickname']);
            }
            if(isset($F['plz'])) {
                $member->setPlz($F['plz']);
            }
            if(isset($F['city'])) {
                $member->setCity($F['city']);
            }
            if(isset($F['address'])) {
                $member->setAddress($F['address']);
            }
            if(isset($F['phone'])) {
                $member->setPhone($F['phone']);
            }
            if(isset($F['status']) && in_array($F['status'], $statusIds)) {
                $newStatus = $repository->find(intval($F['status']));
                $member->setStatus($newStatus);
            }
            $entityManager->flush();
        }

        return $this->render('admin_detail/member.html.twig', [
            'firstname' => $member->getFirstname(),
            'nickname' => $member->getNickname(),
            'lastname' => $member->getLastname(),
            'email' => $member->getEmail(),
            'plz' => $member->getPlz(),
            'city' => $member->getCity(),
            'address' => $member->getAddress(),
            'phone' => $member->getPhone(),
            'status' => $member->getStatus(),
            'id' => $member->getID(),
            'allStatus' => $parsedStatus,
        ]);
    }
    #[Route('/admin/detail/role/{roleId}', name: 'app_admin_detail_role')]
    public function roles($roleId, EntityManagerInterface $entityManager): Response
    {
        $role = $entityManager->getRepository(MemberStatus::class)->find($roleId);

        if(isset($_POST['status'])) {
            $F = [];
            foreach ($_POST['status'] as $k => $v) {
                if(strlen($v)) {
                    $F[$k] = $v;
                }
                if(isset($F['title'])) {
                    $role->setTitle($F['title']);
                }
                if(isset($F['color'])) {
                    $color = $F['color'];
                    $color = str_replace('#', '', $color);
                    $role->setColor($color);
                }
            }
            $entityManager->flush();
        }

        return $this->render('admin_detail/role.html.twig', [
            'title' => $role->getTitle(),
            'color' => $role->getColor(),
            'id' => $role->getId(),
        ]);
    }
}
