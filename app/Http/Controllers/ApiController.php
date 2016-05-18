<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class ApiController extends Controller
{

    public function littleRedData(){

    $result['data'] = DB::table('little_reds')
                         ->select('little_reds.id as Id',
                                  'little_red_name as Name',
                                  'little_reds.slug as Slug',
                                  'blue_name as Blue',
                                  'little_reds.created_at as Created')
                         ->leftJoin('blues', 'blue_id', '=', 'blues.id')
                         ->get();

        return json_encode($result);

    }

    public function littleRedVueData(Request $request){

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

        if ($request->has('keyword')){

            $keyword = $request->get('keyword');

            $littleReds = DB::table('little_reds')
                ->select('little_reds.id as Id',
                         'little_red_name as Name',
                         'little_reds.slug as Slug',
                         'blue_name as Blue',
                         'little_reds.created_at as Created')
                ->leftJoin('blues', 'blue_id', '=', 'blues.id')
                ->where('little_red_name', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(10);

            return response()->json($littleReds);



        }

        $littleReds = DB::table('little_reds')
                             ->select('little_reds.id as Id',
                                      'little_red_name as Name',
                                      'little_reds.slug as Slug',
                                      'blue_name as Blue',
                                      'little_reds.created_at as Created')
                             ->leftJoin('blues', 'blue_id', '=', 'blues.id')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($littleReds);

    }



    public function blueData(){

        $result['data'] = DB::table('blues')
                         ->select('id as Id',
                                  'blue_name as Name',
                                  'slug as Slug',
                                  'created_at as Created')
                         ->get();

        return json_encode($result);

    }

    public function blueVueData(Request $request){

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

        if ($request->has('keyword')){

            $keyword = $request->get('keyword');

            $blues = DB::table('blues')
                ->select('id as Id',
                    'blue_name as Name',
                    'slug as Slug',
                    'created_at as Created')
                ->where('blue_name', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(10);

            return response()->json($blues);



        }

        $blues = DB::table('blues')
                             ->select('id as Id',
                                      'blue_name as Name',
                                      'slug as Slug',
                                      'created_at as Created')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($blues);

    }


    public function gadgetData(){

    $result['data'] = DB::table('gadgets')
                         ->select('gadgets.id as Id',
                                  'gadget_name as Name',
                                  'widget_name as Widget',
                                  'gadgets.created_at as Created')
                         ->leftJoin('widgets', 'widget_id', '=', 'widgets.id')
                         ->get();

        return json_encode($result);

    }

    public function gadgetVueData(Request $request){

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

        if ($request->has('keyword')){

            $keyword = $request->get('keyword');

            $gadgets = DB::table('gadgets')
                ->select('gadgets.id as Id',
                         'gadget_name as Name',
                         'widget_name as Widget',
                         'gadgets.created_at as Created')
                ->leftJoin('widgets', 'widget_id', '=', 'widgets.id')
                ->where('gadget_name', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(10);

            return response()->json($gadgets);



        }

        $gadgets = DB::table('gadgets')
                             ->select('gadgets.id as Id',
                                      'gadget_name as Name',
                                      'widget_name as Widget',
                                      'gadgets.created_at as Created')
                             ->leftJoin('widgets', 'widget_id', '=', 'widgets.id')
                             ->orderBy($column, $direction)
                             ->paginate(10);

        return response()->json($gadgets);

    }



    public function widgetData(){

        $result['data'] = DB::table('widgets')
                         ->select('id as Id',
                                  'widget_name as Name',
                                  'created_at as Created')
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

        if ($request->has('keyword')){

            $keyword = $request->get('keyword');

            $widgets = DB::table('widgets')
                ->select('id as Id',
                    'widget_name as Name',
                    'created_at as Created')
                ->where('widget_name', 'like', '%' . $keyword . '%')
                ->orderBy($column, $direction)
                ->paginate(10);

            return response()->json($widgets);



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
