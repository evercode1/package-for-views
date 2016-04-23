<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class ApiController extends Controller
{

    public function grapeData(){

        $result['data'] = DB::table('grapes')
            ->select('id',
                     'grape_name',
                     'created_at')
            ->get();

        return json_encode($result);

    }

    public function grapeVueData()
    {

        $grapes = DB::table('grapes')
                 ->select('id as Id',
                          'grape_name as Name',
                          'created_at as Created')
                 ->get();

        return $grapes;

    }



    public function appleData(){

        $result['data'] = DB::table('apples')
            ->select('id',
                     'apple_name',
                     'created_at')
            ->get();

        return json_encode($result);

    }

    public function appleVueData()
    {

        $apples = DB::table('apples')
                 ->select('id as Id',
                          'apple_name as Name',
                          'created_at as Created')
                 ->get();

        return $apples;

    }



    public function gadgetData(){

        $result['data'] = DB::table('gadgets')
            ->select('id',
                     'gadget_name',
                     'created_at')
            ->get();

        return json_encode($result);

    }

    public function gadgetVueData()
    {

        $gadgets = DB::table('gadgets')
                 ->select('id as Id',
                          'gadget_name as Name',
                          'created_at as Created')
                 ->get();

        return $gadgets;

    }



    public function widgetData(){

        $result['data'] = DB::table('widgets')
            ->select('id',
                     'widget_name',
                     'created_at')
            ->get();

        return json_encode($result);

    }

    public function widgetVueData()
    {

        $widgets = DB::table('widgets')
                 ->select('id as Id',
                          'widget_name as Name',
                          'created_at as Created')
                 ->get();

        return $widgets;

    }


}
