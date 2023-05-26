<?php

namespace App\Controller;

use App\Entity\Member;
use App\Entity\MemberStatus;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AdminNewController extends AbstractController
{
    #[Route('/admin/new/member', name: 'app_admin_new_member')]
    public function member(EntityManagerInterface $entityManager): Response
    {
        $member = new Member();
        $member->setStatus($entityManager->getRepository(MemberStatus::class)->find(1));
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

    #[Route('/admin/new/user/{userMemberId}', name: 'app_admin_new_user')]
    public function user($userMemberId, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $member = $entityManager->getRepository(Member::class)->find($userMemberId);
        if($member->getAuthUser() == null) {
            $password = $this->randomPassword();
            try {
                $user = new User();
                $hashedPassword = $passwordHasher->hashPassword($user, $password);
                $user->setMember($member);
                $user->setPassword($hashedPassword);
                $user->setRole('ROLE_USER');
                $entityManager->persist($user);
                $member->setAuthUser($user);
                $entityManager->flush();
            } catch (\Exception $e) {
                return new Response('<h1>Something\'s wrong, I can feel it!</h1>' . '<p>Fehler: ' . $e . '</p>');
            }
            return $this->render('admin_new/user.html.twig', [
                'userId' => $user->getId(),
                'password' => $password,
                'firstname' => $member->getFirstname(),
                'lastname' => $member->getLastname(),
                'mail' => $member->getEmail(),
            ]);
        }
        return $this->redirectToRoute('app_admin_overview_members');
    }

    private function randomPassword(): string {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890_!?$+-@&=%#*()[]';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 16; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
            str_replace($alphabet[$n], '', $alphabet);
        }
        return implode($pass);
    }

}
