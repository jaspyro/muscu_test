<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class afficherPageController extends AbstractController
{
    /**
     * @Route("/admin/padm", name="page_admin")
     */
    public function afficher_Padm()
    {
        return $this->render('pages_test/page_administrateur.html.twig');
    }

    /**
     * @Route("/redac/pada", name="page_redac")
     */
    public function afficher_Pada()
    {
        return $this->render('pages_test/page_redacteur.html.twig');
    }

    /**
     * @Route("/user/pase", name="page_user")
     */
    public function afficher_pase()
    {
        return $this->render('pages_test/page_user.html.twig');
    }

    /**
     * @Route("/user/past", name="affichageTest")
     */
    public function affichageTest()
    {
        return $this->render('pages_test/accesPage.html.twig');
    }
}