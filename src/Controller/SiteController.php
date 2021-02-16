<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        return $this->render('site/home.html.twig', [
            'controller_name' => 'SiteController',
            'title' => 'Page d\'accueil'
        ]);
    }

    /**
     * @Route("/mentions", name="mentions")
     */
    public function mentions(): Response
    {
      return $this->render('site/mentions.html.twig', [
          'controller_name' => 'MentionsController',
          'title' => 'Mentions légales'
      ]);
    }
}
