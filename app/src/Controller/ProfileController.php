<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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

    #[Route('/profile/change-password', name: 'app_profile_password')]
    public function password(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
        $errors = [];
        if (isset($_POST['password']) && isset($_POST['passwordRepeat'])) {
            $newPw = strip_tags($_POST['password']);
            $repeatPw = strip_tags($_POST['passwordRepeat']);
            if($newPw != $repeatPw) {
                $errors[] = 'Die Passwörter sind nicht identisch';
            }
            if(strlen($newPw) < 8) {
                $errors[] = 'Das Passwort muss mindestens 8 Zeichen haben.';
            }
            if (!preg_match('/[_!?$+\-@&=%#\*\(\)\[\]]/', $newPw))
            {
                $errors[] = 'Das Passwort muss mindestens 1 Sonderzeichen enthalten';
            }
            if (!preg_match('/\d/', $newPw)) {
                $errors[] = 'Das Passwort muss mindestens 1 Zahl enthalten';
            }
            if (!preg_match('/[A-Z]/', $newPw))
            {
                $errors[] = 'Das Passwort muss mindestens 1 grossen Buchstaben enthalten';
            }
            if (!preg_match('/[a-z]/', $newPw))
            {
                $errors[] = 'Das Passwort muss mindestens 1 kleinen Buchstaben enthalten';
            }

            if(!count($errors)) {
                try {
                    $hashedPassword = $passwordHasher->hashPassword($user, $newPw);
                    $user->setPassword($hashedPassword);
                    $entityManager->flush();
                } catch (\Exception $e) {
                    return new Response('<h1>Something\'s wrong, I can feel it!</h1>' . '<p>Fehler: ' . $e . '</p>');
                }
                return $this->redirectToRoute('app_logout');
            }
        }
        return $this->render('user/password.html.twig', [
            'errors' => $errors,
        ]);
    }
}
