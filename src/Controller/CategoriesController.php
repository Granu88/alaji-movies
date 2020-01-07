<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categories;

class CategoriesController extends AbstractController
{
  /**
   * @Route("/categories", name="categories")
   */
  public function index()
  {
    $categories = $this->getDoctrine()
      ->getRepository(Categories::class)
      ->findBy([],['name'=>'ASC']);

    return $this->render('/categories/index.html.twig', [
        'categories' => $categories,
    ]);
  }

  /**
   * @Route("/categories/{id}", name="categorie")
   */
  public function categorie($id)
  {
    $categorie = $this->getDoctrine()
      ->getRepository(Categories::class)
      ->find($id);

    return $this->render('/categories/categorie.html.twig', [
      'categorie' => $categorie,
    ]);
  }
}
