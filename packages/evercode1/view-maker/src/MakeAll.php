<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;
use Carbon\Carbon;

class MakeAll extends Command
{
    use BuildsCrudTemplates, ConfiguresCrudInput, WritesCrudFiles, FormatsInput, BuildsTemplates, WritesViewFiles;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:all
                           {ModelName}
                           {MasterPage}
                           {TemplateType=plain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create model, route, controller, migration, factory, test and views';


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

        // setup for crud

        $this->modelName = $this->argument('ModelName');

        $this->setCrudTokens();

        $this->setFilePaths();

        // setup for views

        $this->setConfigFromInputs();

        // runs all commands

        if  ($this->makeCrudFiles() &&
             $this->makeViewDirectory()->makeViewFiles($this->templateType)){

            $this->sendSuccessMessage();

            return;

        }


        $this->error('Oops, something went wrong!');


    }

    private function sendSuccessMessage()
    {

        $this->info('Crud Files successfully created');

    }


}
