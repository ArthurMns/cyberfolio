<?php

namespace App\Controller;

use App\Entity\Portfolio;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        // Récupérer tous les profils depuis la base de données
        $portfolio = $entityManager->getRepository(Portfolio::class)->find(id: 1);

        // Vérifiez si des profils existent
        if (!$portfolio) {
            $portfolio = []; // Evitez les erreurs si aucun profil n'existe
        }

        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
            'portfolio' => $portfolio,
        ]);
    }
}
