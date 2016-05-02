<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BigOrangeTest extends TestCase
{
    public function testCreateNewBigOrange()
    {

        $randomString = str_random(10);

        $this->visit('/big-orange/create')
              ->type($randomString, 'big_orange_name')
              ->press('Create')
              ->seePageIs('/big-orange');
    }
}