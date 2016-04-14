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

    private $modelName;

    private $folderName;

    private $folderPath;

    private $paths = [];

    public $tokens = [];

    private $validTemplateTypes = ['plain',
                                   'basic',
                                   'dt',
                                   'vue'];

    private function setConfigFromInputs()
    {
        // sets inputs from the artisan command line arguments

        $this->inputs = $this->argument();

        $this->folderName = $this->inputs['FolderName'];

        $this->modelName = $this->formatModelName($this->folderName);

        $this->masterPage = $this->inputs['MasterPage'];

        $this->templateType = $this->inputs['TemplateType'];

        $this->folderPath = strtolower('resources/views/' . $this->folderName);

        $this->validateTemplateTypeInput();

        $this->setViewList();

        $this->setFilePaths();

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

    private function formatModelName($folderName)
    {

        if (str_contains($folderName, '-')){

            return $this->modelName = camel_case($folderName);

        }

        return $this->modelName = strtolower($folderName);


    }

    // create and set the file paths to the $this->paths array

    private function setFilePaths()
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
    }

    private function setTokens()
    {

        $this->tokens['folderName'] = $this->folderName;
        $this->tokens['modelName'] = $this->modelName;
        $this->tokens['masterPage'] = $this->masterPage;

    }




}