<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoafTest extends TestCase
{
    public function testCreateNewLoaf()
    {

        $randomString = str_random(10);

        $this->visit('/loaf/create')
              ->type($randomString, 'loaf_name')
              ->press('Create')
              ->seePageIs('/loaf');
    }
}