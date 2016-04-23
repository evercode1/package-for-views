<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BigDrumTest extends TestCase
{
    public function testCreateNewBigDrum()
    {

        $randomString = str_random(10);

        $this->visit('/big-drum/create')
              ->type($randomString, 'big_drum_name')
              ->press('Create')
              ->seePageIs('/big-drum');
    }
}