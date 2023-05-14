<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $member = $this->getUser()->getMember();
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
            $entityManager->flush();
        }

        return $this->render('user/index.html.twig', [
            'firstname' => $member->getFirstname(),
            'nickname' => $member->getNickname(),
            'lastname' => $member->getLastname(),
            'email' => $member->getEmail(),
            'plz' => $member->getPlz(),
            'city' => $member->getCity(),
            'address' => $member->getAddress(),
            'phone' => $member->getPhone(),
            'status' => $member->getStatus(),
        ]);
    }
}
