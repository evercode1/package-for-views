<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BigWidgetTest extends TestCase
{
    public function testCreateNewBigWidget()
    {

        $randomString = str_random(10);

        $this->visit('/big-widget/create')
              ->type($randomString, 'big_widget_name')
              ->press('Create')
              ->seePageIs('/big-widget');
    }
}