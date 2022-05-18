<?php

namespace App\Controller\Instructor;

use App\Entity\Section;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted("ROLE_INSTRUCTOR")]
#[Route('/instructor')]
class SectionController extends AbstractController
{
    // #[Route('/sections', name: 'sections')]
    // public function index(SectionRepository $sectionRepository): Response
    // {
    //     $sections = $sectionRepository->findAll();

    //     return $this->render('sections/sections_instructor.html.twig', [
    //         'sections' => $sections,
    //     ]);
    // }

    // #[Route('/section/{id}', name: 'instructor_section')]
    // public function instructorSection($id,
    // sectionRepository $sectionRepository): Response
    // {
    //     $sections = $sectionRepository->find($id);

    //     return $this->render('sections/sections_instructor.html.twig', [
    //         'section' => $sections
    //     ]);
    // }

    // #[Route('/section/new', name: 'section_new')]
    // public function newSection(
    //     Request $request, 
    //     EntityManagerInterface $entityManager): Response
    // {
    //     $section = new section();

    //     $originalLesson = new ArrayCollection();

    //     foreach ($section->getLesson() as $lesson) {
    //         $originalLesson->add($lesson);
    //     }

    //     $section = $this->createForm(sectionType::class, $section);
        
    //     $section->handleRequest($request);

    //     if ($section->isSubmitted() && $section->isValid()) {
    //         // get rid of one section
    //         foreach ($originalLesson as $lesson) {
    //             if ($entityManager->$section->getLesson()->contains($lesson) === false) {
    //                 $entityManager->remove($lesson);
    //             }
    //         }

    //         $entityManager->persist($section);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('sections');
    //     }

    //     return $this->render('sections/section_new.html.twig', [
    //         'sectionForm' => $section->createView()
    //     ]);
    // }

    // #[Route('/section/{id}/update', name: 'section_update')]
    // public function updatesection(
    //     int $id,
    //     Request $request, 
    //     EntityManagerInterface $entityManager,
    //     sectionRepository $sectionRepository): Response
    // {
    //     $section = $sectionRepository->find($id);
        
    //     $originalLesson = new ArrayCollection();

    //     foreach ($section->getLesson() as $lesson) {
    //         $originalLesson->add($lesson);
    //     }

    //     $section = $this->createForm(sectionType::class, $section);
        
    //     $section->handleRequest($request);

    //     if ($section -> isSubmitted() && $section->isValid()) {
    //         foreach ($originalLesson as $lesson) {
    //             if ($entityManager->$section->getLesson()->contains($lesson) === false) {
    //                 $entityManager->remove($lesson);
    //             }
    //         }
            
    //         $entityManager->persist($section);
    //         $entityManager->flush();
    //     }

    //     return $this->render('sections/section_update.html.twig', [
    //         'sectionForm' => $section->createView()
    //     ]);
    // }
   
    // public function deletesection($id, 
    //     sectionRepository $sectionRepository, 
    //     EntityManagerInterface $entityManager): Response 
    // {
    //     $section = $sectionRepository->find($id);

    //     $entityManager->remove($section);
    //     $entityManager->flush();

    //     $this->addFlash('success', 'Suppression réussie');

    //     return $this->redirectToRoute('sections/sections_instructor.html.twig');
    // }
}
