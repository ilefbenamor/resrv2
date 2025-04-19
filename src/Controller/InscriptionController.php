<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;



final class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(Request $request): Response


    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
