<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PlumTest extends TestCase
{
    public function testCreateNewPlum()
    {

        $randomString = str_random(10);

        $this->visit('/plum/create')
            ->type($randomString, 'plum_name')
            ->press('Create')
            ->seePageIs('/plum');
    }
}