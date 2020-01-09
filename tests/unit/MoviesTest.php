<?php namespace App\Tests;

use App\Entity\Movies;

class MoviesTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testGetMovieFeature()
    {
      $this->tester->seeInRepository(Movies::class, [
        'name' => 'Les débutantes'
      ]);
    }

    public function testAddMovieFeature()
    {
      $movie = new Movies;
      $movie->setName('Tony et ses chiennes');
      $movie->setDate(new \DateTime('2002-8-02'));

      $em = $this->getModule('Doctrine2')->em;
      $em->persist($movie);
      $em->flush();

      $this->assertEquals('Tony et ses chiennes', $movie->getName());
      $this->tester->seeInRepository(Movies::class, [
        'name' => 'Tony et ses chiennes'
      ]);
    }
}
