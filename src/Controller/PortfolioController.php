<?php

namespace App\Controller;

use App\Entity\Portfolio;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/portfolio/{id}', name: 'portfolio_detail')]
    public function show(Portfolio $portfolio): Response
    {
        // Récupération des projets, skills et technologies liés au portfolio
        $projects = $portfolio->getProjects();
        $skills = $portfolio->getSkills();
        $technologies = $portfolio->getTechnologies();

        return $this->render('portfolio/index.html.twig', [
            'portfolio' => $portfolio,
            'projects' => $projects,
            'skills' => $skills,
            'technologies' => $technologies,
        ]);
    }
}
