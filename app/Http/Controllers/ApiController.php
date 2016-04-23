<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class ApiController extends Controller
{

    public function drumData(){

        $result['data'] = DB::table('drums')
                         ->select('id',
                                  'drum_name',
                                  'created_at')
                         ->get();

        return json_encode($result);

    }

    public function drumVueData(){

        $drums = DB::table('drums')
                             ->select('id as Id',
                                      'drum_name as Name',
                                      'created_at as Created')
                             ->get();

        return $drums;

    }



    public function loafData(){

        $result['data'] = DB::table('loaves')
                         ->select('id',
                                  'loaf_name',
                                  'created_at')
                         ->get();

        return json_encode($result);

    }

    public function loafVueData(){

        $loaves = DB::table('loaves')
                             ->select('id as Id',
                                      'loaf_name as Name',
                                      'created_at as Created')
                             ->get();

        return $loaves;

    }



    public function loafData(){

        $result['data'] = DB::table('loaves')
                         ->select('id',
                                  'loaf_name',
                                  'created_at')
                         ->get();

        return json_encode($result);

    }

    public function loafVueData(){

        $loaves = DB::table('loaves')
                             ->select('id as Id',
                                      'loaf_name as Name',
                                      'created_at as Created')
                             ->get();

        return $loaves;

    }



    public function categoryData(){

        $result['data'] = DB::table('categories')
            ->select('id',
                     'category_name',
                     'created_at')
            ->get();

        return json_encode($result);

    }

    public function categoryVueData(){

        $categories = DB::table('categories')
                 ->select('id as Id',
                          'category_name as Name',
                          'created_at as Created')
                 ->get();

        return $categories;

    }



    public function plumData(){

        $result['data'] = DB::table('plums')
            ->select('id',
                     'plum_name',
                     'created_at')
            ->get();

        return json_encode($result);

    }

    public function plumVueData()
    {

        $plums = DB::table('plums')
                 ->select('id as Id',
                          'plum_name as Name',
                          'created_at as Created')
                 ->get();

        return $plums;

    }






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
