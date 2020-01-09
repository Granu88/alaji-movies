<?php
namespace App\Tests;
use App\Entity\Authors;

class AuthorsTest extends \Codeception\Test\Unit
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

    public function testGetAuthorFeature()
    {
      $this->tester->seeInRepository(Authors::class, [
        'name' => 'George Lucas'
      ]);
    }

    public function testAddAuthorFeature()
    {
      $author = new Authors;
      $author->setName('Marc Dorcel');
      $author->setBirthday(new \DateTime('1964-8-02'));

      $em = $this->getModule('Doctrine2')->em;
      $em->persist($author);
      $em->flush();

      $this->assertEquals('Marc Dorcel', $author->getName());
      $this->tester->seeInRepository(Authors::class, [
        'name' => 'Marc Dorcel'
      ]);
    }
}
