<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\MoviesType;
use App\Entity\Movies;

class MoviesController extends AbstractController
{
  /**
   * @Route("/movies/add", name="admin_addmovies")
   */
  public function add(Request $request)
  {
    $movie = new Movies;
    $form = $this->createForm(MoviesType::class, $movie)
    ->add('save', SubmitType::class, [
      'label' => "Ajouter"
    ]);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $movie = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($movie);
      $entityManager->flush();
      return $this->redirectToRoute('admin_editmovies', [
        'id' => $movie->getId()
      ]);
    }

    return $this->render('admin/movies/add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/movies/edit/{id}", name="admin_editmovies")
   */
  public function edit(Request $request, $id)
  {

    $movie = $this->getDoctrine()->getRepository(Movies::class)->find($id);
    $form = $this->createForm(MoviesType::class, $movie)
    ->add('save', SubmitType::class, [
      'label' => "Editer"
    ]);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $movie = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($movie);
      $entityManager->flush();
    }

    return $this->render('admin/movies/edit.html.twig', [
      'form' => $form->createView(),
      'movie' => $movie,
    ]);
  }
}
