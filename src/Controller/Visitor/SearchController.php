<?php

namespace App\Controller\Visitor;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function searchFormation(
        Request $request,
        FormationRepository $formationRepository)
    {

        $search = $request->query->get('search');
        $formations = $formationRepository->searchFormation($search);

        return $this->render('home/search_formations_visite.html.twig', [
            'searchFormations' => $formations
        ]);
    }

    #[Route('/student/search', name: 'student_search')]
    public function studentSearchFormation(
        Request $request,
        FormationRepository $formationRepository)
    {

        $search = $request->query->get('search');
        $formations = $formationRepository->searchFormation($search);

        return $this->render('student/studentSearch_formations.html.twig', [
            'searchStudentFormations' => $formations
        ]);
    }

    #[Route('/instructor/search', name: 'instructor_search')]
    public function instructorSearchFormation(
        Request $request,
        FormationRepository $formationRepository)
    {

        $search = $request->query->get('search');
        $formations = $formationRepository->searchFormation($search);

        return $this->render('instructor/instructorSearch_formations.html.twig', [
            'searchInstructorFormations' => $formations
        ]);
    }
}
