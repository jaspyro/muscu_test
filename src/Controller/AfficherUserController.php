<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\IdentificationType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherUserController extends AbstractController
{
    /**
     * @Route("/admin/afficher", name="afficher_user")
     */
    public function afficher(Request $request, UserRepository $repository)
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

        return $this->render('afficherUser.html.twig', [
           'formUser' => $formUser->createView(),
           'user' => $user
        ]);
    }

    /**
     * @Route("/afficher/{id}", name="suprimer_user", methods={"DELETE", "GET"})
     */
    public function delete(UserRepository $repository, $id, EntityManagerInterface $manager, Request $request)
    {
    $User = $repository->find($id);

    if ($this->isCsrfTokenValid('DELETE'.$User->getId(), $request->request->get('_token')))
        {
           $manager->remove($User);
           $manager->flush();

           return $this->redirectToRoute('afficher_user');
        }
    else
        {
        return $this->redirectToRoute('afficher_user');
        }
    }

    /**
     * @Route("/afficher_user/P_AD/{id}", name="passer_admin", methods={"GET", "PUT"})
     */
    public function PasserAdmin(UserRepository $repository, $id, EntityManagerInterface $manager)
    {
        $User = $repository->find($id);

        try {
            $User->setRoles(["ROLE_ADMIN"]);
            $manager->persist($User);
            $manager->flush();
        } catch (\exception $exception)
            {
                $this->addFlash('warning','Un probleme est survenue !');
                return $this->redirectToRoute('afficher_user');
            }
        return $this->redirectToRoute('afficher_user');
    }

    /**
     * @Route("/afficher_user/P_RE/{id}", name="passer_redac", methods={"GET", "PUT"})
     */
    public function PasserRedac(UserRepository $repository, $id, EntityManagerInterface $manager)
    {
        $User = $repository->find($id);

        try {
            $User->setRoles(["ROLE_REDAC"]);
            $manager->persist($User);
            $manager->flush();
        } catch (\exception $exception)
            {
                $this->addFlash('warning','Un probleme est survenue !');
                return $this->redirectToRoute('afficher_user');
            }
        return $this->redirectToRoute('afficher_user');
    }

    /**
     * @Route("/afficher_user/P_US/{id}", name="passer_user", methods={"GET", "PUT"})
     */
    public function PasserUser(UserRepository $repository, $id, EntityManagerInterface $manager)
    {
        $User = $repository->find($id);

        try {
            $User->setRoles(["ROLE_USER"]);
            $manager->persist($User);
            $manager->flush();
        } catch (\exception $exception)
            {
                $this->addFlash('warning','Un probleme est survenue !');
                return $this->redirectToRoute('afficher_user');
            }
        return $this->redirectToRoute('afficher_user');
    }

}
