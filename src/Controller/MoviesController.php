<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Movies;

class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
      $movies = $this->getDoctrine()
        ->getRepository(Movies::class)
        ->findBy([],['name'=>'ASC']);

      $moviesList = $paginator -> paginate(
        $movies,
        $request -> query -> getInt('page', 1),
        18
      );

      return $this->render('movies/index.html.twig', [
          'movies' => $movies,
          'moviesList' => $moviesList,
        ]);
    }

    /**
     * @Route("/movie/{id}", name="movie")
     */
    public function currentMovie($id)
    {
      $movie = $this->getDoctrine()
        ->getRepository(Movies::class)
        ->find($id);

      return $this->render('movie/index.html.twig', [
        'movie' => $movie,
        ]);
    }
}
