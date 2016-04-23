<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GrapeTest extends TestCase
{
    public function testCreateNewGrape()
    {

        $randomString = str_random(10);

        $this->visit('/grape/create')
            ->type($randomString, 'grape_name')
            ->press('Create')
            ->seePageIs('/grape');
    }
}