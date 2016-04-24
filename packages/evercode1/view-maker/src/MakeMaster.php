<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;

class MakeMaster extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:master
                           {MasterPageName}
                           {AppName=Demo}';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'create master page';

    protected $masterName;

    protected $files = [];

    protected $appName;



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

        $this->masterName = $this->argument('MasterPageName');
        $this->appName = $this->argument('AppName');

        $this->setFileNamesAndPaths();


        if ( $this->makeLayoutsFolder()->makeMasterFiles() ) {

            $this->sendSuccessMessage();

            return;

        }

        $this->error('Oops, something went wrong!');


    }

    private function sendSuccessMessage()
    {

        $this->info('Master Page successfully created');

    }

    private function makeLayoutsFolder()
    {
        if (file_exists(base_path('/resources/views/layouts')))
        {

            $this->error('layouts folder already exists!');

            die();

        }

        mkdir(base_path('/resources/views/layouts'));


        return $this;
    }

    private function makeMasterFiles()
    {

        $this->writeEachMasterFile($this->appName, $this->files);

        return $this;

    }

    private function setFileNamesAndPaths()
    {

        $this->files[$this->masterName] = base_path('resources/views/layouts/'. $this->masterName . '.blade.php');
        $this->files['css'] = base_path('resources/views/layouts/css.blade.php');
        $this->files['scripts'] = base_path('resources/views/layouts/scripts.blade.php');
        $this->files['nav'] = base_path('resources/views/layouts/nav.blade.php');
        $this->files['bottom'] = base_path('resources/views/layouts/bottom.blade.php');
        $this->files['meta'] = base_path('resources/views/layouts/meta.blade.php');
        $this->files['shim'] = base_path('resources/views/layouts/shim.blade.php');
    }

    private function writeEachMasterFile($appName, array $files)
    {
        foreach ($files as $fileName => $filePath) {

                $txt = $this->getMasterTemplate($appName, $fileName, $this->masterName);

                $handle = fopen($filePath, "w");

                fwrite($handle, $txt);

                fclose($handle);


        }
    }

    private function getMasterTemplate($appName, $fileName, $masterName)
    {

        $buildMaster = new MasterPageTemplates($appName);

        switch ($fileName){

            case $masterName :

                return $buildMaster->masterTemplate();

                break;

            case 'css' :

                return $buildMaster->cssTemplate();

                break;

            case 'nav' :

                return $buildMaster->navTemplate();

                break;

            case 'scripts' :

                return $buildMaster->scriptsTemplate();

                break;

            case 'bottom' :

                return $buildMaster->bottomTemplate();

                break;

            case 'meta' :

                return $buildMaster->metaTemplate();

                break;

            case 'shim' :

                return $buildMaster->shimTemplate();

                break;

            default:

                return 'Filename not recongnized';

        }




    }


}
