<?php

namespace App\Controller;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminOverviewController extends AbstractController
{

    #[Route('/admin/overview/members', name: 'app_admin_overview_members')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Member::class);

        $queryBuilder = $repository->createQueryBuilder('e')
            ->orderBy('e.lastname', 'ASC'); // Sorting by lastname in ascending order

        $query = $queryBuilder->getQuery();
        $members = $query->getResult();

        return $this->render('admin_overview/members.html.twig', [
            'members' => $members,
        ]);
    }
}
