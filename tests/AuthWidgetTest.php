<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthWidgetTest extends TestCase
{
    public function testCreateNewAuthWidget()
    {

        $randomString = str_random(10);

        $this->visit('/auth-widget/create')
              ->type($randomString, 'auth_widget_name')
              ->press('Create')
              ->seePageIs('/auth-widget');
    }
}