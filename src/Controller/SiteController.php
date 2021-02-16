<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beer;
use App\Entity\Category;



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
     * @Route("/menu", name="menu")
     */
    public function menu(): Response
    {
        $repoCat= $this->getDoctrine()->getRepository(Category::class);
        $beersCategory = $repoCat ->findByTerm('normal');
        
        return $this->render('menu/menu.html.twig', [
            'controller_name' => 'SiteController',
            'title' => 'Page de menu',
            'beersCategory' =>  $beersCategory
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
