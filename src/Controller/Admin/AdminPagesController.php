<?php

namespace App\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_ADMIN")]
#[Route('/admin')]
class AdminPagesController extends AbstractController
{
    #[Route('/home', name: 'admin_home')]
    public function adminHome(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');

        return $this->render('admin/home_admin.html.twig', [
            'home' => 'Home',
        ]);
    }

    #[Route('/instructors', name: 'admin_instructors')]
    public function adminInstructors(): Response
    {
        return $this->render('admin/admin_instructors.html.twig', [
            'instructors' => 'instructors',
        ]);
    }

    #[Route('/students', name: 'admin_students')]
    public function adminStudents(): Response
    {
        return $this->render('base/notYet.html.twig', [
            'students' => 'Students',
        ]);
    }
}
