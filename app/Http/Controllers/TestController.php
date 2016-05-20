<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use App\Http\Requests;

class TestController extends Controller
{
    Public function index()
    {

        $extractFromFiles['factory'] = base_path('database/factories/ModelFactory.php');


        $modelName = 'Blue';

        $start = '// Begin ' . $modelName .  ' Factory';

        $end = '// End ' . $modelName . ' Factory';


        $replaceWith = "";

//read the entire string
        $str=file_get_contents($extractFromFiles['factory']);

        $stringToDelete = $this->patternMatch($start, $end, $str);

        //dd($existing);

//replace something in the file string - this is a VERY simple example
       $str=str_replace("$stringToDelete", "$replaceWith",$str);

//write the entire string
        file_put_contents($extractFromFiles['factory'], $str);

        dd('done');
        $model = 'BigBone';

        $migrationModelName = str_plural(snake_case($model));

        $file = 'create_' .$migrationModelName . '_table';

        $migrations = scandir(base_path('database/migrations')) ;

        foreach ($migrations as $migration){

            if( str_contains($migration, $file)){

                $file = $migration;
            }

        }

        dd($file);



        // match file to string match



        return view('test.index');


    }

    /**
     * @param $start
     * @param $end
     * @param $str
     * @param $matches
     * @return null
     */
    private function patternMatch($start, $end, $str)
    {
        $pattern = sprintf(
            '/%s(.+?)%s/ims',
            preg_quote($start, '/'), preg_quote($end, '/')
        );

        if (preg_match($pattern, $str, $matches)) {

            $existing = ($matches[0]);

            return $existing;

        } else {

            $existing = null;

            return $existing;
        }
    }
}
