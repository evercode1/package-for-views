<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;
use Carbon\Carbon;

class MakeCrud extends Command
{
    use BuildsCrudTemplates, FormatsInput, ConfiguresCrudInput, WritesCrudFiles, HasParentAndChildAndSlug;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud
                           {ModelName}
                           {Slug=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create model, migration, route, controller, factory, and test';





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

        $this->modelName = $this->formatModel($this->argument('ModelName'));

        $this->slug = $this->argument('Slug');

        $this->setCrudTokens();

        $this->setFilePaths();

        if ( $this->makeCrudFiles() ) {

            $this->sendSuccessMessage();

            return;

        }

        $this->error('Oops, something went wrong!');


    }

    private function sendSuccessMessage()
    {

        $this->info('Crud Files successfully created');

    }

    private function formatModel($model)
    {
        $model = camel_case($model);
        $model = str_singular($model);
        return $model = ucwords($model);

    }


}
