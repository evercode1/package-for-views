<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class ApiController extends Controller
{

    public function bigWidgetData(){

        $result['data'] = DB::table('big_widgets')
                         ->select('id',
                                  'big_widget_name',
                                  'created_at')
                         ->get();

        return json_encode($result);

    }

    public function bigWidgetVueData(){

        $bigWidgets = DB::table('big_widgets')
                             ->select('id as Id',
                                      'big_widget_name as Name',
                                      'created_at as Created')
                             ->get();

        return response()->json($bigWidgets);

    }



    public function widgetData(){

        $result['data'] = DB::table('widgets')
                         ->select('id',
                                  'widget_name',
                                  'created_at')
                         ->get();

        return json_encode($result);

    }

    public function widgetVueData(){

        $widgets = DB::table('widgets')
                             ->select('id as Id',
                                      'widget_name as Name',
                                      'created_at as Created')
                                      ->get();

        return $widgets;

    }


}
