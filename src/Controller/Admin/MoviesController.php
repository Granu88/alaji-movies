<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    /**
     * @Route("/movies", name="admin_addmovies")
     */
    public function add()
    {
        return $this->render('admin/movies/add.html.twig', [
            'controller_name' => 'MoviesController',
        ]);
    }
}
