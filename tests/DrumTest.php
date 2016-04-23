<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DrumTest extends TestCase
{
    public function testCreateNewDrum()
    {

        $randomString = str_random(10);

        $this->visit('/drum/create')
              ->type($randomString, 'drum_name')
              ->press('Create')
              ->seePageIs('/drum');
    }
}