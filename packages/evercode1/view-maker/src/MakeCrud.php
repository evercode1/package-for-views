<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;
use Carbon\Carbon;

class MakeCrud extends Command
{
    use BuildsCrudTemplates, ConfiguresCrudInput, WritesCrudFiles;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud
                           {ModelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create crud';





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

        $this->modelName = $this->argument('ModelName');

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


}