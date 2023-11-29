<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{

    /**
     * @Route("/", name="app_profile_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        return $this->renderForm('profile/edit.html.twig', [
            'user' => $user
        ]);
    }

}
