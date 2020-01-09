<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Form\AuthorsType;
use App\Entity\Authors;

class AuthorsController extends AbstractController
{
  /**
   * @Route("/authors/add", name="admin_addauthors")
   */
  public function add(Request $request)
  {
    $author = new Authors;
    $form = $this->createForm(AuthorsType::class, $author)
    ->add('save', SubmitType::class, [
      'label' => "Ajouter"
    ]);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $author = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($author);
      $entityManager->flush();
      return $this->redirectToRoute('admin_editauthors', [
        'id' => $author->getId()
      ]);
    }

    return $this->render('admin/authors/add.html.twig', [
      'form' => $form->createView()
    ]);
  }

  /**
   * @Route("/authors/edit/{id}", name="admin_editauthors")
   */
  public function edit(Request $request, $id)
  {
    $author = $this->getDoctrine()->getRepository(Authors::class)->find($id);
    $form = $this->createForm(AuthorsType::class, $author)
    ->add('save', SubmitType::class, [
      'label' => "Editer"
    ]);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $author = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($author);
      $entityManager->flush();
    }

    return $this->render('admin/authors/edit.html.twig', [
      'form' => $form->createView()
    ]);
  }
}
