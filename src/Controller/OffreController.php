<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Form\OffreType;
use App\Repository\OffreRepository;
use Doctrine\ORM\EntityManagerInterface;
use \Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OffreController extends AbstractController
{
    /**
     * @Route("/redac/Gérer_offre", name="GérerOffre")
     */
    public function gererOffre(Request $request, OffreRepository $repository)
    {
        $Offre = new Offre();

        $formOffre = $this->createForm(OffreType::class,$Offre);
        $formOffre->handleRequest($request);

        if ($formOffre->isSubmitted() && $formOffre->isValid())
            {
                $Of=$this->getDoctrine()->getManager();
                $Of->persist($Offre);
                $Of->flush();
            }

        $Offre = $repository->findAll();


        return $this->render('offre/GérerOffre.html.twig',[
            'formOffre' => $formOffre->createView(),
            'offres' => $Offre
        ]);
    }

    /**
     * @Route("/nos_offre", name="offre")
     */
    public function nosOffre(Request $request, OffreRepository $repository)
    {
        $Offre = new Offre();

        $formOffre = $this->createForm(OffreType::class,$Offre);
        $formOffre->handleRequest($request);

        if ($formOffre->isSubmitted() && $formOffre->isValid())
        {
            $Of=$this->getDoctrine()->getManager();
            $Of->persist($Offre);
            $Of->flush();
        }

        $Offre = $repository->findAll();

        return $this->render('offre/afficherOffre.html.twig',[
            'formOffre' => $formOffre->createView(),
            'offres' => $Offre
        ]);
    }
    /**
     * @Route("/supr/{id}", name="suprimer_offre", methods={"DELETE", "GET"})
     */
    public function suprimer(OffreRepository $repository,$id,EntityManagerInterface $manager,Request $request)
    {
        $offre = $repository->find($id);

        if ($this->isCsrfTokenValid('DELETE'.$offre->getId(), $request->request->get('_token')))
        {
            $manager->remove($offre);
            $manager->flush();

            return $this->redirectToRoute('GérerOffre.html.twig');
        }
        else
        {
            return $this->redirectToRoute('GérerOffre.html.twig');
        }
    }
}
