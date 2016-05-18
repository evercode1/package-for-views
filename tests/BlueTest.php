<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BlueTest extends TestCase
{
    public function testCreateNewBlue()
    {

        $randomString = str_random(10);

        $this->visit('/blue/create')
              ->type($randomString, 'blue_name')
              ->press('Create')
              ->seePageIs('/blue');
    }
}