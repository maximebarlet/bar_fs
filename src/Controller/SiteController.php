<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beer;



class SiteController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home(): Response
    {
        $repoBeer = $this->getDoctrine()->getRepository(Beer::class);

        $lastBeers = $repoBeer->findByCategory();

        return $this->render('site/home.html.twig', [
            'controller_name' => 'SiteController',
            'title' => 'Page d\'accueil',
            'last3beers' =>  $lastBeers
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
