<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;

class MakeViews extends Command
{
    use BuildsTemplates;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:views
                           {ModelName}
                           {MasterPage}
                           {type=plain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create views';

    private $inputs = [];

    protected $views = ['create',
                        'show',
                        'edit',
                        'index'];

    protected $DatatablesViews = ['datatable',
                                  'datatable-script'];

    private $type;

    private $masterPage;

    private $modelName;

    private $folderPath;

    private $paths = [];


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $this->setInputsFromArtisan();

       if ( $this->makeViewDirectory()->makeViewFiles($this->type) ) {

            $this->sendSuccessMessage();

           return;

       }

        $this->error('Oops, something went wrong!');


    }

    // make view directory

    private function makeViewDirectory()
    {


        if (file_exists(base_path($this->folderPath)))
        {

            $this->error($this->modelName. ' folder already exists!');

             die();

        }

        mkdir(base_path($this->folderPath));

        return $this;
    }


    //make view files based on type, plain, basic or dt

    private function makeViewFiles($type)
    {

        switch($type){

            case 'plain' :

                //dd('make it plain');

                return $this->makeFiles('plain');

                break;

            case 'basic'  :

                return $this->makeFiles('basic');

                break;

            case 'dt'  :

                $this->views = array_merge($this->views, $this->DatatablesViews);

                return $this->makeFiles('dt');

                break;

            default:

                $this->error($type . ' is not a valid type');

                die();

        }



    }

    // make stubs called by makeViewFiles, type is plain, basic or dt

    private function makeFiles($type)
    {

        $this->setFilePaths();


        $this->writeFiles($type);

        return $this;

    }

    private function sendSuccessMessage()
    {

        $this->info('Views successfully created');

    }

    private function setInputsFromArtisan()
    {
        // sets inputs from the artisan command line arguments

        $this->inputs = $this->argument();

        // need to format model name here

        $this->modelName = $this->inputs['ModelName'];

        $this->masterPage = $this->inputs['MasterPage'];

        $this->type = $this->inputs['type'];

        $this->folderPath = strtolower('resources/views/' . $this->modelName);

    }


    // create and set the file paths to the $this->paths array

    private function setFilePaths()
    {
        foreach ($this->views as $key => $file) {

            $this->paths[ $key ][ $file ] = (base_path($this->folderPath)) . '/' . $file . '.blade.php';

        }
    }

    /**
     * @param $type
     * use the $this->paths array to get name of each file, then call makeEachFile
     */
    private function writeFiles($type)
    {
        foreach ($this->paths as $numkey => $name) {

            $this->makeEachFile($type, $name);

        }
    }

    /**
     * @param $type
     * @param $name
     *
     * creates the files
     * $name is handed in as an array
     * calls getTemplate from the HasTemplates trait
     */
    private function makeEachFile($type, $name)
    {
        foreach ($name as $filename => $filepath) {

            if ( ! is_array($filename)) {

                $txt = $this->getTemplate($filename, $type, $this->masterPage, $this->modelName);

                $handle = fopen($filepath, "w");

                fwrite($handle, $txt);

                fclose($handle);
            }

        }
    }


}
