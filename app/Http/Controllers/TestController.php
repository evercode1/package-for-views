<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use App\Http\Requests;

class TestController extends Controller
{
    Public function index()
    {
        $string = 'BigFish';

        $output = strtolower(snake_case($string)) . '_id';

        $count = Widget::count();

        return view('test.index', compact('output', 'count'));


    }
}
