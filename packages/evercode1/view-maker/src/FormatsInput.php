<?php

namespace Evercode1\ViewMaker;

trait FormatsInput
{

    private $inputs = [];

    protected $views = ['create',
                        'show',
                        'edit',
                        'index'];

    protected $DatatablesViews = ['datatable',
                                  'datatable-script'];

    private $templateType;

    private $masterPage;

    private $theModel;

    private $folderName;

    private $folderPath;

    private $paths = [];

    public $tokens = [];

    private $index;

    private $validTemplateTypes = ['plain',
                                   'basic',
                                   'dt',
                                   'vue'];

    private function setConfigFromInputs()
    {
        // sets inputs from the artisan command line arguments

        $this->inputs = $this->argument();

        $this->theModel = $this->inputs['ModelName'];

        $this->folderName = $this->formatModelPath($this->theModel);

        $this->masterPage = $this->inputs['MasterPage'];

        $this->templateType = $this->inputs['TemplateType'];

        $this->folderPath = strtolower('resources/views/' . $this->folderName);

        $this->index = strtolower($this->inputs['IndexOnly']);

        $this->validateTemplateTypeInput();

        $this->setViewList();

        $this->setViewFilePaths();

        $this->setTokens();


    }

    private function validateTemplateTypeInput()
    {

      if ($this->templateTypeNotValid($this->templateType)){


          $this->error($this->templateType . ' is not a valid type');

          die();

      }


    }

    private function templateTypeNotValid($templateType)
    {
         return ! in_array($templateType, $this->validTemplateTypes);

    }



    private function formatModelPath($model)
    {
        $model = preg_split('/(?=[A-Z])/',$model);

        $model = implode('-', $model);

        $model = ltrim($model, '-');

        return $model = strtolower($model);

    }

    // create and set the file paths to the $this->paths array

    private function setViewFilePaths()
    {
        foreach ($this->views as $key => $file) {

            $this->paths[ $key ][ $file ] = (base_path($this->folderPath)) . '/' . $file . '.blade.php';

        }
    }

    private function setViewList()
    {
        if ($this->templateType == 'dt') {

            $this->views = array_merge($this->views, $this->DatatablesViews);
        }

        if ($this->index == 'index'){

            switch($this->templateType){

                case 'dt':

                    array_push($this->DatatablesViews, 'index');
                    $this->views = $this->DatatablesViews;
                    break;

                Default:

                    $this->views = ['index'];
                    break;


            }


        }
    }

    private function setTokens()
    {

        $this->tokens['folderName'] = $this->folderName;
        $this->tokens['modelName'] = $this->theModel;
        $this->tokens['masterPage'] = $this->masterPage;

    }




}