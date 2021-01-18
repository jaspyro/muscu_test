<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\IdentificationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription(Request $request, UserRepository $repository)
    {
        $user = new User();

        $formUser = $this->createForm(IdentificationType::class,$user);
        $formUser->handleRequest($request);

        if ($formUser->isSubmitted() && $formUser->isValid())
        {
            $Us=$this->getDoctrine()->getManager();
            $Us->persist($user);
            $Us->flush();
        }

        $user = $repository->findAll();

        return $this->render('inscription.html.twig', [
        'formuser' => $formUser->createView(),
        'user' => $user
    ]);
    }
}
