<?php

namespace Evercode1\ViewMaker;

use Illuminate\Console\Command;

class MakeViews extends Command
{
    use FormatsInput, BuildsTemplates, WritesViewFiles, HasParentAndChildAndSlug;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:views
                           {ModelName}
                           {MasterPage}
                           {TemplateType}
                           {Slug=false}
                           {IndexOnly=false}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create views';



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


        $this->setConfigFromInputs();



       if ( $this->makeViewDirectory()->makeViewFiles($this->templateType) ) {

            $this->sendSuccessMessage();

           return;

       }

        $this->error('Oops, something went wrong!');


    }

    private function sendSuccessMessage()
    {

        $this->info('Views successfully created');

    }


}
