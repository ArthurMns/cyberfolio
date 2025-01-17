<?php

namespace App\Controller;

use App\Entity\Portfolio;
use App\Entity\Project;
use App\Entity\Skills;
use App\Form\SkillsType;
use App\Entity\Technology;
use App\Form\TechnologyType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ProjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\HttpFoundation\RedirectResponse;

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

    #[Route('/portfolio/{id}/add-project', name: 'portfolio_add_project')]
    public function addProject(Request $request, Portfolio $portfolio, EntityManagerInterface $entityManager): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
    
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $project->setPortfolio($portfolio);
            $entityManager->persist($project);
            $entityManager->flush();
    
            return $this->redirectToRoute('portfolio_detail', ['id' => $portfolio->getId()]);
        }
    
        return $this->render('portfolio/add_project.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    #[Route('/project/{id}/delete', name: 'project_delete', methods: ['POST'])]
    public function deleteProject(
        int $id,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager,
        Request $request
    ): RedirectResponse {
        // Vérification du token CSRF
        $submittedToken = $request->request->get('_token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('delete' . $id, $submittedToken))) {
            throw $this->createAccessDeniedException('Action non autorisée.');
        }

        // Récupération du projet
        $project = $entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Projet non trouvé.');
        }

        // Suppression du projet
        $entityManager->remove($project);
        $entityManager->flush();

        // Redirection vers la page du portfolio
        return $this->redirectToRoute('portfolio_detail', ['id' => $project->getPortfolio()->getId()]);
    }



    #[Route('/portfolio/{id}/add-skill', name: 'portfolio_add_skill')]
    public function addSkill(Request $request, Portfolio $portfolio, EntityManagerInterface $entityManager): Response
    {
        // Créez une nouvelle instance de Skill
        $skill = new Skills();

        // Créez le formulaire en liant l'entité Skills
        $form = $this->createForm(SkillsType::class, $skill);
        $form->handleRequest($request);

        // Vérifiez si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Associez la compétence au portfolio
            $skill->setPortfolio($portfolio);

            // Persistez l'entité et enregistrez dans la base de données
            $entityManager->persist($skill);
            $entityManager->flush();

            // Redirigez vers la page de détail du portfolio
            return $this->redirectToRoute('portfolio_detail', ['id' => $portfolio->getId()]);
        }

        // Affichez le formulaire dans le template
        return $this->render('portfolio/add_skill.html.twig', [
            'portfolio' => $portfolio,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/skill/{id}/delete', name: 'skill_delete', methods: ['POST'])]
    public function deleteSkill(
        int $id,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager,
        Request $request
    ): RedirectResponse {
        // Vérification du token CSRF
        $submittedToken = $request->request->get('_token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('delete' . $id, $submittedToken))) {
            throw $this->createAccessDeniedException('Action non autorisée.');
        }

        // Récupération de la compétence
        $skill = $entityManager->getRepository(Skills::class)->find($id);

        if (!$skill) {
            throw $this->createNotFoundException('Compétence non trouvée.');
        }

        // Suppression de la compétence
        $entityManager->remove($skill);
        $entityManager->flush();

        // Redirection vers la page du portfolio
        return $this->redirectToRoute('portfolio_detail', ['id' => $skill->getPortfolio()->getId()]);
    }



    #[Route('/portfolio/{id}/add-technology', name: 'portfolio_add_technology')]
    public function addTechnology(Request $request, Portfolio $portfolio, EntityManagerInterface $entityManager): Response
    {
        // Créez une nouvelle instance de Technology
        $technology = new Technology();

        // Créez le formulaire en liant l'entité Technology
        $form = $this->createForm(TechnologyType::class, $technology);
        $form->handleRequest($request);

        // Vérifiez si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Associez la technologie au portfolio
            $technology->setPortfolio($portfolio);

            // Persistez l'entité et enregistrez dans la base de données
            $entityManager->persist($technology);
            $entityManager->flush();

            // Redirigez vers la page de détail du portfolio
            return $this->redirectToRoute('portfolio_detail', ['id' => $portfolio->getId()]);
        }

        // Affichez le formulaire dans le template
        return $this->render('portfolio/add_technology.html.twig', [
            'portfolio' => $portfolio,
            'form' => $form->createView(),
        ]);
    }


    #[Route('/technology/{id}/delete', name: 'technology_delete', methods: ['POST'])]
    public function deleteTechnology(
        int $id,
        EntityManagerInterface $entityManager,
        CsrfTokenManagerInterface $csrfTokenManager,
        Request $request
    ): RedirectResponse {
        // Vérification du token CSRF
        $submittedToken = $request->request->get('_token');
        if (!$csrfTokenManager->isTokenValid(new CsrfToken('delete' . $id, $submittedToken))) {
            throw $this->createAccessDeniedException('Action non autorisée.');
        }

        // Récupération de la technologie
        $technology = $entityManager->getRepository(Technology::class)->find($id);

        if (!$technology) {
            throw $this->createNotFoundException('Technologie non trouvée.');
        }

        // Suppression de la technologie
        $entityManager->remove($technology);
        $entityManager->flush();

        // Redirection vers la page du portfolio
        return $this->redirectToRoute('portfolio_detail', ['id' => $technology->getPortfolio()->getId()]);
    }

}
