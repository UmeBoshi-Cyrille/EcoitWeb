<?php

namespace App\Controller\Student;

use App\Repository\FormationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_STUDENT")]
#[Route('/student')]
class StudentPagesController extends AbstractController
{
    #[Route('/home', name: 'student_home')]
    public function studentHome(): Response
    {
        return $this->render('student/home_student.html.twig', [
            'home' => 'Home',
        ]);
    }

    #[Route('/contact', name: 'student_contact')]
    public function studentContact(): Response
    {
        return $this->render('home/contact.html.twig', [
            'contact' => 'Contact',
        ]);
    }

    #[Route('/apply', name: 'student_apply')]
    public function studentApply(): Response
    {
        return $this->render('login/apply.html.twig', [
            'apply' => 'Apply',
        ]);
    }

    #[Route('/formations', name: 'student_formations')]
    public function studentFormations(FormationRepository $formationRepository): Response
    {
        $studentFormations = $formationRepository->findAll();

        return $this->render('student/formations_student.html.twig', [
            'student_formations' => $studentFormations
        ]);
    }

    #[Route('/formation/{id}', name: 'student_formation')]
    public function studentFormation(int $id,
        FormationRepository $formationRepository
    ): Response
    {

        $studentFormation = $formationRepository->find($id);
        // $studentSections = $sectionsRepository-

        return $this->render('student/formation_student.html.twig', [
            'student_formation' => $studentFormation,
        ]);
    }

    #[Route('/account', name: 'student_account')]
    public function notYet(): Response
    {
        return $this->render('base/notYet.html.twig', [
            'account' => 'Account',
        ]);
    }
}
