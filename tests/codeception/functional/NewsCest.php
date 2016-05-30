<?php

namespace tests\codeception\functional;

use FunctionalTester;
use Yii;

class NewsCest
{
    public function indexPage(FunctionalTester $I)
    {
        $I->wantTo('ensure that news page works');

        $I->amOnPage(Yii::$app->homeUrl);
        $I->seeLink('News');
        $I->click('News');

        $I->see('News', 'h1');
    }
}