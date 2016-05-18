<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;
use Carbon\Carbon;

class MakeChildOf extends Command
{
    use BuildsCrudTemplates,
        ConfiguresCrudInput,
        WritesCrudFiles,
        FormatsInput,
        BuildsTemplates,
        WritesViewFiles,
        HasParentAndChildAndSlug;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:child-of
                           {ParentName}
                           {ChildName}
                           {MasterPage}
                           {TemplateType}
                           {Slug=false}
                           {IndexOnly=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create child of parent';

    protected $parentModelPath;


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

        // Do Once for Parent, and Once for child

        // setup for crud

        $this->modelName = $this->formatModel($this->argument('ParentName'));

        $this->slug = $this->argument('Slug');

        $this->setParentModelPath($this->modelName);

        $this->setCrudTokens();

        // add tokens for parent and child the crudTokens array



        $this->setParentChildTokens();



        //$this->setFilePaths();



        // setup for views


        $this->setParentConfigFromInputs();



        // runs all commands

        if  ($this->appendToParentModel()){

            $this->sendSuccessMessage('parent');



        } else {

            $this->error('Oops, something went wrong!');

            return;
        }

        // reset model to child

        $this->modelName = $this->formatModel($this->argument('ChildName'));

        $this->setCrudTokens();

        // add tokens for parent and child the crudTokens array

        $this->setParentChildTokens();

        $this->setFilePaths();

        // setup for views


        $this->setChildConfigFromInputs();

        // runs all commands

        if  ($this->makeCrudFiles() &&
            $this->makeViewDirectory()->makeViewFiles($this->templateType)){

            $this->sendSuccessMessage('child');

            return;

        } else {

            $this->error('Oops, something went wrong!');

            return;
        }


    }

    private function sendSuccessMessage($type)
    {

        if ($type == 'parent'){

            $this->info('Parent Model files successfully modified');
        } else {

            $this->info('All Child files successfully created');
        }



    }

    private function formatModel($model)
    {
        $model = camel_case($model);
        $model = str_singular($model);
        return $model = ucwords($model);

    }

    private function setParentChildTokens()
    {

        $this->crudTokens['parent'] = $this->formatModel($this->argument('ParentName'));
        $this->crudTokens['child'] = $this->formatModel($this->argument('ChildName'));

    }

    private function appendToParentModel()
    {

        if(file_exists($this->parentModelPath)){


            $txt = $this->getParentModelCode($this->crudTokens);

            $contents = file_get_contents($this->parentModelPath);

            $classParts = explode(';', $contents, 4);

            $txt = $classParts[0] . ";" . $classParts[1]. ";"  .  $classParts[2] . ";\n\n"  . $txt . $classParts[3] ;

            $handle = fopen($this->parentModelPath, "w");

            fwrite($handle, $txt);

            fclose($handle);

            return $this;


        } else {

            return 'Parent Model File Does Not Exist';
        }


    }

    private function getParentModelCode(array $tokens)
    {

        $tokenBuilder = new CrudTokens($tokens);

        $content = <<<EOD
    public function :::childRelation:::()
    {

        return \$this->hasMany('App\:::child:::');
    }
EOD;


        $content = $tokenBuilder->insertTokensIntoContent($content);

        return $content;



    }

    private function setParentModelPath()
    {

        $this->parentModelPath = base_path() . '/app/' . $this->modelName . '.php';


    }


}
