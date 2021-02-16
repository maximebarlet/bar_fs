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
     * @Route("/blonde", name="blonde")
     */
    public function blonde(): Response
    {
        $repoCat= $this->getDoctrine()->getRepository(Category::class);
        $beersBlonde = $repoCat ->findByTerm('Blonde');
        
        return $this->render('menu/blonde.html.twig', [
            'controller_name' => 'SiteController',
            'title' => 'Page de menu',
            'beersBlonde' =>  $beersBlonde
        ]); 
    }

    /**
     * @Route("/brune", name="brune")
     */
     public function brune(): Response
     {
         $repoCat= $this->getDoctrine()->getRepository(Category::class);
         $beersBrune = $repoCat ->findByTerm('Brune');
         
         return $this->render('menu/brune.html.twig', [
             'controller_name' => 'SiteController',
             'title' => 'Page de menu',
             'beersBrune' =>  $beersBrune
         ]); 
    }

    /**
     * @Route("/blanche", name="blanche")
     */
     public function blanche(): Response
     {
         $repoCat= $this->getDoctrine()->getRepository(Category::class);
         $beersBlanche = $repoCat ->findByTerm('Blanche');
         
         return $this->render('menu/blanche.html.twig', [
             'controller_name' => 'SiteController',
             'title' => 'Page de menu',
             'beersBlanche' =>  $beersBlanche
         ]); 
    }

     /**
     * @Route("/ambree", name="ambree")
     */
     public function ambree(): Response
     {
         $repoCat= $this->getDoctrine()->getRepository(Category::class);
         $beersBlanche = $repoCat ->findByTerm('Ambrée');
         
         return $this->render('menu/ambree.html.twig', [
             'controller_name' => 'SiteController',
             'title' => 'Page de menu',
             'beersAmbre' =>  $beersAmbree
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
