<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlackHammerTest extends TestCase
{
    public function testCreateNewBlackHammer()
    {

        $randomString = str_random(10);

        $this->visit('/black-hammer/create')
              ->type($randomString, 'black_hammer_name')
              ->press('Create')
              ->seePageIs('/black-hammer');
    }
}