<?php

namespace App\Controller;

use App\Form\LoadType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {

        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $formData =$form->getData();
            $em->persist($formData);
            $em->flush();
            $this->addFlash('success', 'Formulaire envoyé !');
            return $this->redirectToRoute('app_contact');
        }



        $data = $userRepository->findby([], null, 25);

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
            'data' => $data
        ]);
    }
}
