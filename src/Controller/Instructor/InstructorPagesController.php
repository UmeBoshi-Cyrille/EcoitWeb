<?php

namespace App\Controller\Instructor;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_INSTRUCTOR")]
#[Route('/instructor')]
class InstructorPagesController extends AbstractController
{
    #[Route('/home', name: 'instructor_home')]
    public function instructorHome(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_INSTRUCTOR', null, 'User tried to access a page without having ROLE_INSTRUCTOR');

        return $this->render('instructor/home_instructor.html.twig', [
            'home' => 'Home',
        ]);
    }
}
