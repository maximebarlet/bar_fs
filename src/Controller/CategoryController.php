<?php

namespace App\Controller;

use App\Entity\Beer;
use App\Entity\Category;
use App\Form\BeerType;
use App\Form\CategoryType;
use App\Repository\BeerRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
  /**
   * @Route("/category", name="category")
   * @param CategoryRepository $categoryRepository
   * @return Response
   */
  public function index(CategoryRepository $categoryRepository): Response
  {
    dd($categoryRepository->search());
    return $this->render('category/index.html.twig', [
      'categories' => $categoryRepository->search(),
    ]);
  }

  /**
   * @Route("category/new", name="category_new", methods={"GET","POST"})
   * @param Request $request
   * @return Response
   */
  public function new(Request $request): Response
  {
    $category = new Category();
    $form = $this->createForm(CategoryType::class, $category);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($category);
      $entityManager->flush();

      return $this->redirectToRoute('category');
    }

    return $this->render('category/new.html.twig', [
      'category' => $category,
      'form' => $form->createView(),
    ]);
  }

  /**
   * @Route("/category/{id}", name="category_show")
   * @param int $id
   * @return Response
   */
  public function show(int $id): Response
  {
    $category = $this->getDoctrine()
      ->getRepository(Category::class)
      ->find($id);

    if (!$category) {
      throw $this->createNotFoundException(
        'No category found for id '.$id
      );
    }

    return $this->render('category/show.html.twig', ['category' => $category]);

    // or render a template
    // in the template, print things with {{ product.name }}
    // return $this->render('product/show.html.twig', ['product' => $product]);
  }

  /**
   * @Route("/{id}/edit", name="category_edit", methods={"GET","POST"})
   * @param Request $request
   * @param Category $category
   * @return Response
   */
  public function edit(Request $request, Category $category): Response
  {
    $form = $this->createForm(CategoryType::class, $category);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $this->getDoctrine()->getManager()->flush();

      return $this->redirectToRoute('category');
    }

    return $this->render('category/edit.html.twig', [
      'category' => $category,
      'form' => $form->createView(),
    ]);
  }

  /**
   * @Route("/{id}", name="category_delete", methods={"DELETE"})
   * @param Request $request
   * @param Category $category
   * @return Response
   */
  public function delete(Request $request, Category $category): Response
  {
    if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($category);
      $entityManager->flush();
    }

    return $this->redirectToRoute('category');
  }
}
