<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;

class RemoveChildOf extends Command
{
    use FormatsInput, RemovesFiles;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:child-of
                           {ParentName}
                           {ChildName}';

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

        $this->parentName = $this->formatModel($this->argument('ParentName'));

        $this->childName = $this->formatModel($this->argument('ChildName'));

        $this->removeChildRelationFromParent();

        $this->info('Child relationship of ' . $this->childName. ' successfully removed from ' . $this->parentName);

        $this->folderName = $this->formatModelPath($this->argument('ChildName'));


        $path = base_path('resources/views/'. $this->folderName);

        if ( $this->removeViewFiles($path) ) {

            $this->sendViewSuccessMessage();


        } else {

            $this->error('No Such Directory');

        }

        $this->modelName = $this->formatModel($this->argument('ChildName'));

        $this->modelPath = $this->formatModelPath($this->argument('ChildName'));

        $this->setPaths();

        if ( $this->deleteCrudFiles() ) {

            $this->sendSuccessMessage();

            return;

        }

        $this->error('Oops, something went wrong!');




    }

    private function sendViewSuccessMessage()
    {

        $this->info('Folder and View Files for ' . $this->childName . ' successfully removed.');

    }


    private function removeViewFiles($path)
    {

        return $this->deleteDirectoryAndFiles($path);


    }

    private function sendSuccessMessage()
    {

        $this->info('Crud Files for ' . $this->childName . ' successfully removed');

    }

    private function formatModel($model)
    {
        $model = camel_case($model);
        $model = str_singular($model);
        return $model = ucwords($model);

    }

    private function removeChildRelationFromParent()
    {

        $file = base_path('app/'. $this->parentName . '.php');

        $replaceWith = "";

        //read the entire string from file

        $content = file_get_contents($file);

        // define pattern

        $childRelation = $this->formatChildRelation();

        $stringToDelete = <<<EOD
    public function $childRelation()
    {

        return \$this->hasMany('App\\$this->childName');
    }
EOD;

        //replace the file string

        $updatedContent = str_replace($stringToDelete, $replaceWith, $content);

        //writes the entire file with updated content

        file_put_contents($file, $updatedContent);



    }

    private function formatChildRelation()
    {

        $child = camel_case($this->childName);

        return str_plural($child);

    }


}
