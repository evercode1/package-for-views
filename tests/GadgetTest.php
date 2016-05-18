<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GadgetTest extends TestCase
{
    public function testCreateNewGadget()
    {

        $randomString = str_random(10);

        $this->visit('/gadget/create')
              ->type($randomString, 'gadget_name')
              ->select(1, 'widget_id')
              ->press('Create')
              ->seePageIs('/gadget');
    }
}