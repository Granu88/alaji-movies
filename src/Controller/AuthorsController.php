<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Authors;

class AuthorsController extends AbstractController
{
    /**
     * @Route("/authors", name="authors")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
      $authors = $this->getDoctrine()
        ->getRepository(Authors::class)
        ->findBy([],['name'=>'ASC']);

        $authorsList = $paginator -> paginate(
          $authors,
          $request -> query -> getInt('page', 1),
          18
        );

      return $this->render('authors/index.html.twig', [
          'authors' => $authors,
          'authorsList' => $authorsList,
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
