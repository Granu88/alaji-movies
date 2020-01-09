<?php namespace App\Tests;
use App\Tests\AcceptanceTester;

class UserCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function tryToTest(AcceptanceTester $I)
    {
      $I->amOnPage('/login');
      $I->fillField('email', 'davidvallon@hotmail.fr');
      $I->fillField('password', 'alaji');
      $I->click('Connectez vous');
      $I->see('Réalisateurs');
    }
}
