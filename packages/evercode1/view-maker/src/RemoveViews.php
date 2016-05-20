<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;

class RemoveViews extends Command
{
    use FormatsInput, RemovesFiles;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:views
                           {ModelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove view files';





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

            $this->sendSuccessMessage();

            return;

        }

        $this->error('No Such Directory');


    }

    private function sendSuccessMessage()
    {

        $this->info('Folder and View Files for ' . $this->folderName . ' successfully removed.');

    }


    private function removeViewFiles($path)
    {

       return $this->deleteDirectoryAndFiles($path);


    }


}
