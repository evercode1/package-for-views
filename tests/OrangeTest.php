<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrangeTest extends TestCase
{
    public function testCreateNewOrange()
    {

        $randomString = str_random(10);

        $this->visit('/orange/create')
              ->type($randomString, 'orange_name')
              ->press('Create')
              ->seePageIs('/orange');
    }
}