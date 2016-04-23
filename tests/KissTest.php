<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class KissTest extends TestCase
{
    public function testCreateNewKiss()
    {

        $randomString = str_random(10);

        $this->visit('/kiss/create')
            ->type($randomString, 'kiss_name')
            ->press('Create')
            ->seePageIs('/kiss');
    }
}