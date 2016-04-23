<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppleTest extends TestCase
{
    public function testCreateNewApple()
    {

        $randomString = str_random(10);

        $this->visit('/apple/create')
            ->type($randomString, 'apple_name')
            ->press('Create')
            ->seePageIs('/apple');
    }
}