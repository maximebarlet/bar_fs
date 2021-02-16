<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Form\BeerType;
use App\Repository\BeerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BeerController extends AbstractController
{
  /**
   * @Route("/beer", name="beer")
   * @param BeerRepository $beerRepository
   * @param $categories
   * @return Response
   */
    public function index(BeerRepository $beerRepository, $categories): Response
    {
      dd($beerRepository->findByCategory(1));
      return $this->render('beer/index.html.twig', [
        'beers' => $beerRepository->findByCategory(1),
      ]);
    }

  /**
   * @Route("beer/new", name="beer_new", methods={"GET","POST"})
   * @param Request $request
   * @return Response
   */
    public function new(Request $request): Response
    {
      $beer = new Beer();
      $form = $this->createForm(BeerType::class, $beer);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($beer);
        $entityManager->flush();

        return $this->redirectToRoute('beer');
      }

      return $this->render('beer/new.html.twig', [
        'beer' => $beer,
        'form' => $form->createView(),
      ]);
    }

  /**
   * @Route("/beer/{id}", name="beer_show")
   * @param int $id
   * @return Response
   */
  public function show(int $id): Response
  {
    $beer = $this->getDoctrine()
      ->getRepository(Beer::class)
      ->find($id);

    if (!$beer) {
      throw $this->createNotFoundException(
        'No product found for id '.$id
      );
    }

    return $this->render('beer/show.html.twig', ['beer' => $beer]);

    // or render a template
    // in the template, print things with {{ product.name }}
    // return $this->render('product/show.html.twig', ['product' => $product]);
  }

  /**
   * @Route("/{id}/edit", name="beer_edit", methods={"GET","POST"})
   * @param Request $request
   * @param Beer $beer
   * @return Response
   */
  public function edit(Request $request, Beer $beer): Response
  {
    $form = $this->createForm(BeerType::class, $beer);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('beer');
    }

    return $this->render('beer/edit.html.twig', [
      'beer' => $beer,
      'form' => $form->createView(),
    ]);
  }

  /**
   * @Route("/{id}", name="beer_delete", methods={"DELETE"})
   * @param Request $request
   * @param Beer $beer
   * @return Response
   */
  public function delete(Request $request, Beer $beer): Response
  {
    if ($this->isCsrfTokenValid('delete'.$beer->getId(), $request->request->get('_token'))) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($beer);
      $entityManager->flush();
    }

    return $this->redirectToRoute('beer');
  }

}
