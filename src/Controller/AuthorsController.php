<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Authors;

class AuthorsController extends AbstractController
{
    /**
     * @Route("/authors", name="authors")
     */
    public function index()
    {
      $authors = $this->getDoctrine()
        ->getRepository(Authors::class)
        ->findBy([],['name'=>'ASC'],21,0);

      return $this->render('authors/index.html.twig', [
          'authors' => $authors,
        ]);
    }

    /**
     * @Route("/author/{id}", name="author")
     */
    public function currentAuthor($id)
    {
      $author = $this->getDoctrine()
        ->getRepository(Authors::class)
        ->find($id);

      return $this->render('author/index.html.twig', [
        'author' => $author,
        ]);
    }
}
