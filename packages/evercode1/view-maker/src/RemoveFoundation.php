<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;

class RemoveFoundation extends Command
{
    use FormatsInput, RemovesFiles;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:foundation
                           {ModelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove all foundation files';





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

        $this->folderName = $this->formatModelPath($this->argument('ModelName'));


        $path = base_path('resources/views/'. $this->folderName);

        if ( $this->removeViewFiles($path) ) {

            $this->sendViewSuccessMessage();


        } else {

            $this->error('No Such Directory');

        }

        $this->modelName = $this->formatModel($this->argument('ModelName'));

        $this->modelPath = $this->formatModelPath($this->argument('ModelName'));

        $this->setPaths();

        if ( $this->deleteCrudFiles() ) {

            $this->sendSuccessMessage();

            return;

        }

        $this->error('Oops, something went wrong!');




    }

    private function sendViewSuccessMessage()
    {

        $this->info('Folder and View Files for ' . $this->folderName . ' successfully removed.');

    }


    private function removeViewFiles($path)
    {

        return $this->deleteDirectoryAndFiles($path);


    }

    private function sendSuccessMessage()
    {

        $this->info('Foundation Crud Files successfully removed');

    }

    private function formatModel($model)
    {
        $model = camel_case($model);
        $model = str_singular($model);
        return $model = ucwords($model);

    }


}
