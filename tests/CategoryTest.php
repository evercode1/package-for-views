<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CategoryTest extends TestCase
{
    public function testCreateNewCategory()
    {

        $randomString = str_random(10);

        $this->visit('/category/create')
            ->type($randomString, 'category_name')
            ->press('Create')
            ->seePageIs('/category');
    }
}