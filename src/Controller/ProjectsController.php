<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectsController extends AbstractController
{
    public function __construct(Protected ProjectRepository $projectRepository)
    {
    }

    #[Route('/projets', name: 'app_projects')]
    public function index(): Response
    {
        $projects = $this->projectRepository->findAll();

        return $this->render('projects/index.html.twig', [
            'menu_class' => 'project-menu',
            'allProjects' => $projects
        ]);
    }

    #[Route('/projects/{id}', name: 'app_projects_details')]
    public function details(#[MapEntity(id: 'id')] Project $project): Response
    {
        return $this->render('projects/details.html.twig', [
            'project' => $project,
            'menu_class' => 'project-menu',
        ]);
    }
}
