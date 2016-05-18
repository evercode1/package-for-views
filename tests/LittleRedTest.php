<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LittleRedTest extends TestCase
{
    public function testCreateNewLittleRed()
    {

        $randomString = str_random(10);

        $this->visit('/little-red/create')
              ->type($randomString, 'little_red_name')
              ->select(1, 'blue_id')
              ->press('Create')
              ->seePageIs('/little-red');
    }
}