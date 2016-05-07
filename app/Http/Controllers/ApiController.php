<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class ApiController extends Controller
{

    public function authWidgetData(){

        $result['data'] = DB::table('auth_widgets')
                         ->select('id',
                                  'auth_widget_name',
                                  'created_at')
                         ->get();

        return json_encode($result);

    }

    public function authWidgetVueData(Request $request){

    $column = 'id';
        $direction = 'asc';

        if ($request->has('column')){

            $column = $request->get('column');
            if ($column == 'Id'){
                $direction = $request->get('direction') == 1 ? 'asc' : 'desc';
            } else {

                $direction = $request->get('direction') == 1 ? 'desc' : 'asc';
            }


        }

        $authWidgets = DB::table('auth_widgets')
                             ->select('id as Id',
                                      'auth_widget_name as Name',
                                      'created_at as Created')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($authWidgets);

    }



    public function widgetData(){

        $result['data'] = DB::table('widgets')
                         ->select('id',
                                  'widget_name',
                                  'created_at')
                         ->get();

        return json_encode($result);

    }

    public function widgetVueData(Request $request){

        $column = 'id';
        $direction = 'asc';

        if ($request->has('column')){

            $column = $request->get('column');
            if ($column == 'Id'){
                $direction = $request->get('direction') == 1 ? 'asc' : 'desc';
            } else {

                $direction = $request->get('direction') == 1 ? 'desc' : 'asc';
            }


        }

        $widgets = DB::table('widgets')
                             ->select('id as Id',
                                      'widget_name as Name',
                                      'created_at as Created')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($widgets);

    }


}
